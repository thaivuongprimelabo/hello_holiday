<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Post;
use Cms\Models\PostTag;
use Cms\Requests\PostRequest;

class PostController extends AppController
{
    public function save(PostRequest $request, Post $post)
    {
        if ($request->isMethod('post')) {

            $post->name = $request->input('name');
            $post->name_url = $this->slugName($post->name);
            $post->description = $request->input('description');
            $post->content = $request->input('content');
            $post->author_name = is_null($request->input('author_name')) ? 'Administrator' : $request->input('author_name');

            $resultUpload = $this->uploadFile->singleUpload('photo');

            if (!empty($resultUpload)) {
                $post->photo = $resultUpload;
            }

            $post->seo_keywords = $request->has('seo_keywords') ? $request->input('seo_keywords') : $request->input('name');
            $post->seo_description = $request->has('seo_description') ? $request->input('seo_description') : $request->input('name');
            $post->status = !is_null($request->status) ? 1 : 0;
            $tags = $request->input('tags');
            if ($tags && count($tags)) {
                $post->tags = implode(',', $tags);
            }
            $post->save();

            if ($post->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.post.list')->with('success', $message);
        }
        $tags = PostTag::query()->active()->get();
        return view('cms::auth.pages.post.form', compact('post', 'tags'));
    }
}
