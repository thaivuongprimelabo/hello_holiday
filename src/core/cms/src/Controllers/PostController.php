<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Post;
use Cms\Requests\PostRequest;
use Illuminate\Support\Str;

class PostController extends AppController
{
    public function save(PostRequest $request, Post $post)
    {
        if ($request->isMethod('post')) {

            $post->name = $request->input('name');
            $post->name_url = Str::of($request->input('name'))->slug('-');
            $post->description = $request->input('description');
            $post->content = $request->input('content');
            $post->author_name = $request->input('author_name', 'Administrator');

            $resultUpload = $this->uploadFile->upload($this->uploadSetting)->first();
            if (!empty($resultUpload)) {
                $post->photo = $resultUpload;
            }

            $post->seo_keywords = $request->input('seo_keywords');
            $post->seo_description = $request->input('seo_description');
            $post->status = !is_null($request->status) ? 1 : 0;
            $post->save();

            if ($post->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.post.list')->with('success', $message);
        }
        return view('cms::auth.pages.post.form', compact('post'));
    }
}
