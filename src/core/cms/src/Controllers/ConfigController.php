<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Config;
use Cms\Requests\ConfigRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Cms\Controllers\AppController;

class ConfigController extends AppController
{

    public function save(ConfigRequest $request) {

        $webConfig = Config::query()->first();

        if($request->isMethod('post')) {

            $webConfig->web_title           = $request->input('web_title');
            $webConfig->web_description     = $request->input('web_description');
            $webConfig->web_keywords        = $request->input('web_keywords');
            // $webConfig->web_logo            = $this->uploadFile->upload(['dir' => 'web_logo'])->first();
            // $webConfig->web_ico             = $this->uploadFile->upload(['dir' => 'web_ico'])->first();
            // $webConfig->web_banner          = $this->uploadFile->upload(['dir' => 'web_banner'])->first();
            $webConfig->facebook_fanpage    = $request->input('facebook_fanpage');
            $webConfig->youtube_channel     = $request->input('youtube_channel');
            $webConfig->zalo_page           = $request->input('zalo_page');
            $webConfig->shopee_page         = $request->input('shopee_page');

            if($request->has('upload_file')) {

                $demension = [
                    'web_logo' => ['width' => 120, 'height' => 120],
                    'web_ico'  => ['width' => 40, 'height' => 40],
                    'web_banner' => ['width' => 725, 'height' => 320],
                ];

                $files = $request->file('upload_file');

                foreach($files as $key=>$file) {
                    $originName = $file->getClientOriginalName();
                    $filename = $file->hashName();

                    $tmpPath = '/cms/upload/' . $key;
                    $uploadPath = public_path($tmpPath);
                    if(!File::exists($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true, true);
                    }

                    $img = Image::make($file->path());
                    $resizeWidth = $demension[$key]['width'];
                    $resizeHeight = $demension[$key]['height'];
                    $img->resize($resizeWidth, $resizeHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($uploadPath . '/' . $file->hashName());

                    $webConfig->$key = $tmpPath . '/' . $file->hashName();

                }
            }

            $webConfig->save();

            if($webConfig->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.config.edit')->with('success', $message);
        }
        return view('cms::auth.pages.config.form', compact('webConfig'));
    }
}
