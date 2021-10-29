<?php

namespace Cms\Controllers;

use App\Http\Controllers\Controller;
use Cms\Constants;
use Cms\Helpers\UploadFile;
use Cms\Models\ActionHistory;
use Cms\Models\Config;
use Cms\Models\Contact;
use Cms\Models\ImageProduct;
use Cms\Models\Order;
use Cms\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AppController extends Controller
{
    protected $uploadFile = null;
    public $config = null;

    public function __construct(UploadFile $uploadFile)
    {
        $this->uploadFile = $uploadFile;

        $this->middleware(function ($request, $next) {
            $this->saveSession();
            ActionHistory::createHistory([
                'action' => Route::getCurrentRoute()->getActionName(),
            ]);

            return $next($request);
        });

    }

    public function saveSession()
    {
        $countNewOrders = Order::query()->where('status', Constants::ORDER_STATUS_NEW)->count();
        $countNewContacts = Contact::query()->where('status', Constants::CONTACT_NEW)->count();
        $config = Config::query()->first();

        if (!is_null(session('countNewOrders'))) {
            if (session('countNewOrders') != $countNewOrders) {
                session(['countNewOrders' => $countNewOrders]);
            }
        } else {
            session(['countNewOrders' => $countNewOrders]);

        }

        if (!is_null(session('countNewContacts'))) {
            if (session('countNewContacts') != $countNewContacts) {
                session(['countNewContacts' => $countNewContacts]);
            }
        } else {
            session(['countNewContacts' => $countNewContacts]);
        }

        if (!is_null(session('config'))) {
            if (session('config') != $config) {
                session(['config' => $config]);
            }
        } else {
            session(['config' => $config]);
        }
    }

    private function getModel()
    {
        $prefix = request()->route()->getPrefix();
        $names = explode('/', $prefix);
        $class = 'Cms\\Models\\' . ucfirst(end($names));
        $model = app($class);
        return $model;
    }

    protected function getView()
    {
        $prefix = request()->route()->getPrefix();
        $names = explode('/', $prefix);
        $view = 'cms::auth.pages.' . end($names);
        return $view;
    }

    public function index()
    {
        return view($this->getView() . '.index');
    }

    public function search(Request $request)
    {
        $model = $this->getModel();
        $query = $model->query();
        $view = $this->getView();
        $searchRequest = $request->all();

        if (isset($searchRequest['name_se']) && !is_null($searchRequest['name_se'])) {
            $query->where('name', 'LIKE', '%' . $searchRequest['name_se'] . '%');
        }

        if (isset($searchRequest['status_se']) && !is_null($searchRequest['status_se'])) {
            $query->where('status', $searchRequest['status_se']);
        }

        if (isset($searchRequest['date_from_se']) && !is_null($searchRequest['date_from_se'])) {
            $query->where('created_at', '>=', Carbon::parse($searchRequest['date_from_se'] . ' 00:00:00')->format('Y-m-d H:i:s'));
        }

        if (isset($searchRequest['date_to_se']) && !is_null($searchRequest['date_to_se'])) {
            $query->where('created_at', '<=', Carbon::parse($searchRequest['date_to_se'] . ' 23:59:00')->format('Y-m-d H:i:s'));
        }

        if (isset($searchRequest['customer_info_se']) && !is_null($searchRequest['customer_info_se'])) {
            $query->where('customer_name', 'LIKE', '%' . $searchRequest['customer_info_se'] . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . $searchRequest['customer_info_se'] . '%')
                ->orWhere('customer_address', 'LIKE', '%' . $searchRequest['customer_info_se'] . '%')
                ->orWhere('customer_email', 'LIKE', '%' . $searchRequest['customer_info_se'] . '%');
        }

        if (isset($searchRequest['user_info_se']) && !is_null($searchRequest['user_info_se'])) {
            $query->where('name', 'LIKE', '%' . $searchRequest['user_info_se'] . '%')
                ->orWhere('phone', 'LIKE', '%' . $searchRequest['user_info_se'] . '%')
                ->orWhere('address', 'LIKE', '%' . $searchRequest['user_info_se'] . '%')
                ->orWhere('email', 'LIKE', '%' . $searchRequest['user_info_se'] . '%');
        }

        if ($model instanceof \Cms\Models\User) {
            $query = $query->showByRole();
        }

        if ($model instanceof \Cms\Models\Banner) {
            $query = $query->where('pos', 'slider');
        }

        $searchList = $query->orderBy('created_at', 'desc')->paginate(6);
        return [
            'search_result' => view($view . '.search_result', compact('searchList'))->render(),
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total(),
        ];
    }

    public function remove(Request $request)
    {
        $model = $this->getModel();
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        // Remove image
        if ($model instanceof Product) {
            $imagesProduct = ImageProduct::query()->whereIn('product_id', $ids)->get();

            foreach ($imagesProduct as $imageProduct) {
                if (File::exists(public_path($imageProduct->image))) {
                    File::delete(public_path($imageProduct->image));
                }

                if (File::exists(public_path($imageProduct->medium))) {
                    File::delete(public_path($imageProduct->medium));
                }

                if (File::exists(public_path($imageProduct->small))) {
                    File::delete(public_path($imageProduct->small));
                }
            }

            ImageProduct::query()->whereIn('product_id', $ids)->delete();
        }
        $model->query()->whereIn('id', $ids)->delete();

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }

    public function slugName($name)
    {
        return Str::of($name)->slug('-');
    }
}
