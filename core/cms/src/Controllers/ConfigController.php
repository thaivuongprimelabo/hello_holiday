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
            $webConfig->bank_info = $request->input('bank_info');
            
            $web_logo   = $this->uploadFile->singleUpload('web_logo');
            $web_ico    = $this->uploadFile->resize('40x40', 'web_ico');
            $web_banner = $this->uploadFile->singleUpload('web_banner');

            $webConfig->web_logo    = !empty($web_logo) ? $web_logo : $webConfig->web_logo;
            $webConfig->web_ico     = !empty($web_ico) ? $web_ico : $webConfig->web_ico;
            $webConfig->web_banner  = !empty($web_banner) ? $web_banner : $webConfig->web_banner;

            $webConfig->max_upload = $request->input('max_upload');
            $webConfig->resize_image = $request->input('resize_image');
            $webConfig->footer = $request->input('footer');

            $webConfig->phone1 = $request->input('phone1');
            $webConfig->phone2 = $request->input('phone2');
            $webConfig->phone3 = $request->input('phone3');
            $webConfig->phone4 = $request->input('phone4');
            $webConfig->phone5 = $request->input('phone5');
            $webConfig->latlong = $request->input('latlong');

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
