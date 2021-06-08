<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Category;
use Cms\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Cms\Helpers\UploadFile;

class AppController extends Controller
{
    protected $uploadFile = null;
    protected $uploadSetting = null;

    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 0;
    const STATUS_DELETED = 2;

    static $modelList = [
        'auth/category' => '\Cms\Models\Category',
        'auth/vendor' => '\Cms\Models\Vendor',
        'auth/user' => '\Cms\Models\User',
    ];

    static $viewList = [
        'auth/category' => 'cms::auth.pages.category',
        'auth/vendor' => 'cms::auth.pages.vendor',
        'auth/user' => 'cms::auth.pages.user',
    ];

    static $uploadSettingList = [
        'auth/user' => [
            'dir' => 'user',
        ],
        'auth/vendor' => [
            'dir' => 'vendor'
        ],
    ];

    public function __construct(UploadFile $uploadFile) {
        $this->uploadFile = $uploadFile;
        if(isset(self::$uploadSettingList[request()->route()->getPrefix()])) {
            $this->uploadSetting = self::$uploadSettingList[request()->route()->getPrefix()];
        }
    }

    private function getModel() {
        $prefix = request()->route()->getPrefix();
        $className = self::$modelList[$prefix];
        $model = app($className);
        return $model;
    }

    private function getView() {
        $prefix = request()->route()->getPrefix();
        $view = self::$viewList[$prefix];
        return $view;
    }

    public function index() {
        return view($this->getView() . '.index');
    }

    public function search(Request $request) {
        $query = $this->getModel()->query();
        $view = $this->getView();
        $searchRequest = $request->all();

        if(isset($searchRequest['name_se']) && !is_null($searchRequest['name_se'])) {
            $query->where('name', 'LIKE', '%' . $searchRequest['name_se'] . '%');
        }

        if(isset($searchRequest['status_se']) && !is_null($searchRequest['status_se'])) {
            $query->where('status', $searchRequest['status_se']);
        }

        if(isset($searchRequest['date_from_se']) && !is_null($searchRequest['date_from_se'])) {
            $query->where('created_at', '>=', Carbon::parse($searchRequest['date_from_se'] . ' 00:00:00')->format('Y-m-d H:i:s'));
        }

        if(isset($searchRequest['date_to_se']) && !is_null($searchRequest['date_to_se'])) {
            $query->where('created_at', '<=', Carbon::parse($searchRequest['date_to_se'] . ' 23:59:00')->format('Y-m-d H:i:s'));
        }

        $searchList = $query->orderBy('created_at', 'desc')->paginate(6);
        return [
            'search_result' => view($view . '.search_result', compact('searchList'))->render(),
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total()
        ];
    }

    public function remove(Request $request) {
        $query = $this->getModel()->query();
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        $query->whereIn('id', $ids)->delete();

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}