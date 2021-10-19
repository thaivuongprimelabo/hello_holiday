<?php

namespace Web\Controllers;

use Cms\Models\Post;
use Illuminate\Http\Request;
use Web\Controllers\AppController;

class PostController extends AppController
{
    public function index()
    {
        $this->setSEO([
            'title' => trans('web::label.news'),
            'url' => route('post.index'),
        ]);

        return view('web::pages.post.index');
    }

    public function getPosts()
    {
        $posts = Post::query()->active()->orderBy('created_at', 'desc')->simplePaginate(8);
        return view('web::pages.post.list', compact('posts'));
    }

    public function detail(Request $request)
    {
        $slug = $request->slug;
        $post = Post::query()->active()->where('name_url', $slug)->first();
        $this->error404($post);
        $this->setSEO([
            'title' => $post->getName(),
            'url' => $post->getLink(),
            'image' => $post->getPhoto(),
            'web_description' => $post->getDescription(),
        ]);

        return view('web::pages.post.detail', compact('post'));

    }
}
