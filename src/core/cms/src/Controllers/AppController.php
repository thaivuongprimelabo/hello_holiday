<?php

namespace Cms\Controllers;

use App\Http\Controllers\Controller;
use Cms\Constants;
use Cms\Helpers\UploadFile;
use Cms\Models\ImageProduct;
use Cms\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class AppController extends Controller
{
    protected $uploadFile = null;
    protected $uploadSetting = null;

    public function __construct(UploadFile $uploadFile)
    {
        $this->uploadFile = $uploadFile;
        if (isset(Constants::$uploadSettingList[request()->route()->getPrefix()])) {
            $this->uploadSetting = Constants::$uploadSettingList[request()->route()->getPrefix()];
        }

    }

    private function getModel()
    {
        $prefix = request()->route()->getPrefix();
        $className = Constants::$modelList[$prefix];
        $model = app($className);
        return $model;
    }

    private function getView()
    {
        $prefix = request()->route()->getPrefix();
        $view = Constants::$viewList[$prefix];
        return $view;
    }

    public function index()
    {
        return view($this->getView() . '.index');
    }

    public function search(Request $request)
    {
        $query = $this->getModel()->query();
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
            $model->query()->whereIn('id', $ids)->delete();
        }

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}
