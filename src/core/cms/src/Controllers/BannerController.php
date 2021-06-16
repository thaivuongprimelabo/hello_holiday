<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Banner;
use Cms\Requests\BannerRequest;

class BannerController extends AppController
{

    public function save(BannerRequest $request, Banner $banner)
    {
        if ($request->isMethod('post')) {

            $banner->description = $request->input('description');
            $banner->link = $request->input('link');
            $banner->pos = $request->input('pos', 'center');

            $resultUpload = $this->uploadFile->upload()->first();
            if (!empty($resultUpload)) {
                $banner->banner = $resultUpload;
            }

            $banner->status = !is_null($request->status) ? 1 : 0;
            $banner->save();

            if ($banner->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.banner.list')->with('success', $message);
        }

        $banner->link = !empty($banner->link) ? $banner->link : route('home');

        return view('cms::auth.pages.banner.form', compact('banner'));
    }
}
