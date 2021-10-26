<?php

namespace Web\Controllers;

use Cms\Models\Post;
use Cms\Models\PostTag;
use Illuminate\Http\Request;
use Web\Controllers\AppController;

class PostController extends AppController
{
    public function index()
    {
        $tags = PostTag::query()->active()->get();
        $this->setSEO([
            'title' => trans('web::label.news'),
            'url' => route('post.index'),
        ]);

        return view('web::pages.post.index', compact('tags'));
    }

    public function postsByTag(Request $request)
    {
        $slug = $request->slug;
        $tag = PostTag::query()->active()->where('name_url', $slug)->first();
        $tags = PostTag::query()->active()->get();

        $this->error404($tag);
        $this->setSEO([
            'title' => $tag->getName(),
            'url' => $tag->getLink(),
        ]);

        $this->output['tag'] = $tag;
        $this->output['tags'] = $tags;

        return view('web::pages.post.tag', $this->output);
    }

    public function getPosts(Request $request)
    {
        $query = Post::query()->active();
        $action = $request->action;
        $slug = $request->slug;
        switch($action) {
            case 'tag': 
                $tag = PostTag::query()->where('name_url', $slug)->first();
                $query = $query->where('tags', 'LIKE', '%' . $tag->id . '%');
                break;
        }
        $posts = $query->orderBy('created_at', 'desc')->simplePaginate(8);
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
