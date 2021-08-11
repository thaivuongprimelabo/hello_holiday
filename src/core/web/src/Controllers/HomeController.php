<?php

namespace Web\Controllers;

use App\Http\Controllers\Controller;
use Web\Controllers\AppController;
use Cms\Models\Category;
use Cms\Models\Banner;
use Cms\Models\Vendor;
use Cms\Models\Post;

class HomeController extends AppController
{
    public function index()
    {
        $categories = Category::query()->active()->where('parent_id', null)->get();
        $vendors = Vendor::query()->active()->get();
        $banners = Banner::query()->active()->where('pos', 'slider')->get();
        $bannerCenter = Banner::query()->active()->where('pos', 'center')->first();
        $posts = Post::query()->orderBy('created_at', 'desc')->limit(4)->get();
        $productCategories = Category::query()->active()->has('products')->limit(2)->get();
        foreach($productCategories as $category) {
            $category->load(['products' => function($query) {
                $query->where('status', 1)->orderBy('created_at', 'desc')->limit(5);
            }]);
        }
        
        $this->setSEO([
            'title' => trans('web::label.home'),
            'url' => route('home'),
        ]);

        return view('web::pages.home.index', compact(
            'categories', 
            'banners', 
            'bannerCenter',
            'vendors',
            'posts',
            'productCategories'
        ));
    }
}
