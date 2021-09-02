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
            $banner->select_type = 'image';
            $banner->pos = 'slider';

            $resultUpload = $this->uploadFile->singleUpload('banner');
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

    public function center(BannerRequest $request, Banner $banner) {

        $bannerCenter = Banner::query()->where('pos', 'center')->first();
        if (!is_null($bannerCenter)) {
            $banner = $bannerCenter;
        }
        
        if ($request->isMethod('post')) {

            $banner->description = $request->input('description');
            $banner->link = $request->input('link');
            $banner->select_type = 'image';
            $banner->pos = 'center';

            $resultUpload = $this->uploadFile->singleUpload('banner');
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

            return back()->with('success', $message);
        }


        return view('cms::auth.pages.banner.center', compact('banner'));

    }
}
