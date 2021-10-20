<?php

namespace Web\Controllers;

use Cms\Models\Post;
use Cms\Models\Product;
use Web\Controllers\AppController;

class SitemapXmlController extends AppController
{
    public function index()
    {
        $home = route('home');
        $about = route('page.about');
        $shopping = route('page.shopping');
        $warranty = route('page.warranty');
        $delivery = route('page.delivery');
        $contact = route('contact.index');
        $posts = Post::query()->active()->get();
        $products = Product::query()->active()->get();
        return response()->view('web::pages.sitemap.index', compact(
            'home', 
            'about', 
            'shopping', 
            'warranty', 
            'delivery', 
            'contact',
            'posts',
            'products',
        ))->header('Content-Type', 'text/xml');
    }
}
