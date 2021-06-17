<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Config;
use Cms\Requests\ConfigRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ConfigController extends AppController
{

    public function save(ConfigRequest $request)
    {
        $webConfig = $request->session()->get('config');
        
        if ($request->isMethod('post')) {

            $webConfig->web_title = $request->input('web_title');
            $webConfig->web_description = $request->input('web_description');
            $webConfig->web_keywords = $request->input('web_keywords');
            $webConfig->facebook_fanpage = $request->input('facebook_fanpage');
            $webConfig->youtube_channel = $request->input('youtube_channel');
            $webConfig->zalo_page = $request->input('zalo_page');
            $webConfig->shopee_page = $request->input('shopee_page');

            $webConfig->company_name = $request->input('company_name');
            $webConfig->company_address = $request->input('company_address');
            $webConfig->company_phone = $request->input('company_phone');
            $webConfig->company_tax = $request->input('company_tax');
            $webConfig->company_email = $request->input('company_email');
            
            $web_logo   = $this->uploadFile->resize('120x120', 'web_logo')->first();
            $web_ico    = $this->uploadFile->resize('40x40', 'web_ico')->first();
            $web_banner = $this->uploadFile->resize('725x320', 'web_banner')->first();

            $webConfig->web_logo    = !empty($web_logo) ? $web_logo : $webConfig->web_logo;
            $webConfig->web_ico     = !empty($web_ico) ? $web_ico : $webConfig->web_ico;
            $webConfig->web_banner  = !empty($web_banner) ? $web_banner : $webConfig->web_banner;

            $webConfig->max_upload = $request->input('max_upload');
            $webConfig->resize_image = $request->input('resize_image');

            $webConfig->save();

            if ($webConfig->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.config.edit')->with('success', $message);
        }
        return view('cms::auth.pages.config.form', compact('webConfig'));
    }
}
