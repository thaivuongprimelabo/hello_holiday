<?php

namespace Web\Controllers;

use Cms\Models\Category;
use Cms\Models\ChildCategory;
use Cms\Models\Product;
use Cms\Models\Tag;
use Illuminate\Http\Request;
use Web\Controllers\AppController;

class ProductController extends AppController
{
    protected $output = [];

    public function __construct()
    {
        parent::__construct();
        $this->output['categories'] = Category::query()->active()->where('parent_id', null)->get();
    }

    public function index(Request $request)
    {
        $this->setSEO([
            'title' => trans('web::label.product'),
            'url' => route('product.index'),
        ]);

        return view('web::pages.product.index', $this->output);

    }

    public function detail(Request $request)
    {
        $slug = $request->slug;
        $product = Product::query()->active()->where('name_url', $slug)->first();
        $otherProducts = Product::query()->active()->where('category_id', $product->category_id)->limit(10)->get();

        $this->error404($product);
        $this->setSEO([
            'title' => $product->getName(),
            'web_description' => $product->seo_description,
            'web_keywords' => $product->seo_keywords,
            'url' => $product->getLink(),
            'image' => optional($product->imagesProduct()->first())->getLargeImage(),
        ]);

        $this->output['product'] = $product;
        $this->output['otherProducts'] = $otherProducts;

        return view('web::pages.product.detail', $this->output);

    }

    public function productsByCategory(Request $request)
    {
        $slug = $request->slug;
        $category = Category::query()->active()->where('name_url', $slug)->first();
        $tags = Tag::query()->active()->productTag()->get();

        $this->error404($category);
        $this->setSEO([
            'title' => $category->getName(),
            'url' => $category->getLink(),
        ]);

        $this->output['category'] = $category;
        $this->output['tags'] = $tags;

        return view('web::pages.product.category', $this->output);
    }

    public function productsByTag(Request $request)
    {
        $slug = $request->slug;
        $tag = Tag::query()->active()->productTag()->where('slug', $slug)->first();
        $tags = Tag::query()->active()->productTag()->get();

        $this->error404($tag);
        $this->setSEO([
            'title' => $tag->getName(),
            'url' => $tag->getProductLink(),
        ]);

        $this->output['tag'] = $tag;
        $this->output['tags'] = $tags;

        return view('web::pages.product.tag', $this->output);
    }

    public function productsByChildCategory(Request $request)
    {
        $slug = $request->child_slug;
        $category = ChildCategory::query()->active()->where('name_url', $slug)->first();
        $this->error404($category);
        $this->setSEO([
            'title' => $category->getName(),
            'url' => $category->getLink(),
        ]);

        $this->output['category'] = $category;

        return view('web::pages.product.category', $this->output);
    }

    public function search(Request $request)
    {

        $this->setSEO([
            'title' => trans('web::label.search'),
            'url' => route('product.search'),
        ]);

        return view('web::pages.product.search', $this->output);
    }

    public function getProducts(Request $request)
    {
        $query = Product::query()->active();
        $action = $request->action;
        $price = $request->price;
        $keyword = $request->keyword;
        $view = 'web::pages.product.list';
        $limit = 9;

        switch ($action) {

            case 'category':
                $slug = $request->slug;
                $child_slug = $request->child_slug;

                if (!is_null($child_slug)) {
                    $category = ChildCategory::query()->active()->where('name_url', $child_slug)->first();
                    $query = $query->where('category_id', $category->getKey());
                } else {
                    $category = Category::query()->active()->where('name_url', $slug)->first();
                    $childCategories = $category->childCategories->pluck('id');
                    $query = $query->whereIn('category_id', $childCategories);
                }
                break;

            case 'other-products':
                $limit = 8;
                $view = 'web::pages.product.other_products';
                $categoryId = $request->category_id;
                $query = $query->where('category_id', $categoryId);
                break;

            case 'tag':
                $slug = $request->slug;
                $tag = Tag::query()->productTag()->where('slug', $slug)->first();
                $query = $query->where('tags', 'LIKE', '%' . $tag->id . '%');
                break;

        }

        switch ($price) {
            case '1':
                $query = $query->where('price', '<', 500000);
                break;
            case '2':
                $query = $query->whereBetween('price', [500000, 1000000]);
                break;
            case '3':
                $query = $query->whereBetween('price', [1000000, 3000000]);
                break;
            case '4':
                $query = $query->where('price', '>', 3000000);
                break;
        }

        if ($keyword) {
            $view = 'web::pages.product.search_list';
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%');
            $limit = 8;
        }

        $products = $query->simplePaginate($limit);

        return view($view, compact('products'))->render();

    }
}
