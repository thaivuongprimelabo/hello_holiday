<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Category;
use Cms\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        return view('cms::auth.pages.category.index');
    }

    public function search(Request $request) {
        $query = Category::query();
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

        $categories = $query->orderBy('created_at', 'desc')->paginate(6);
        return [
            'search_result' => view('cms::auth.pages.category.search_result', compact('categories'))->render(),
            'pagination' => $categories->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $categories->total()
        ];
    }

    public function save(CategoryRequest $request, Category $category) {
        if($request->isMethod('post')) {

            $category->name     = $request->name;
            $category->name_url = Str::of($request->name)->slug('-');;
            $category->parent_id = $request->parent_id;
            $category->status   = !is_null($request->status) ? 1 : 0;
            $category->save();

            if($category->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.category.list')->with('success', $message);
        }
        return view('cms::auth.pages.category.form', compact('category'));
    }

    public function remove(Request $request) {
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        Category::query()->whereIn('id', $ids)->update([
            'status' => 0
        ]);

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }

    public function restore(Request $request) {
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        Category::query()->whereIn('id', $ids)->update([
            'status' => 1
        ]);

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}
