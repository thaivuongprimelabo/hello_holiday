<?php
namespace Cms\Helpers;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UploadFile {

    protected $uploadDir = '/cms/upload';
    protected $fieldName = 'upload_file';
    protected $resizeDir = null;
    protected $saveDir = null;
    protected $resizeWidth = null;
    protected $resizeHeight = null;

    public function upload($params = []) {
        try {
            if(request()->has($this->fieldName)) {
                $file = request()->file($this->fieldName);
                $filename = $file->hashName();
                
                $this->saveDir   = $this->uploadDir;
                $this->uploadDir = public_path($this->uploadDir);
                
                if(isset($params['dir'])) {
                    $this->uploadDir = $this->uploadDir . '/' . $params['dir'];
                    $this->saveDir = $this->saveDir . '/' . $params['dir'];
                }

                $this->resize($params);

                if(!File::exists($this->uploadDir)) {
                    File::makeDirectory($this->uploadDir, 0755, true, true);
                }

                $file->move($this->uploadDir, $filename);
                return $this->saveDir . '/' . $filename;
            }

            return '';

        } catch(\Exception $e) {
            Log::info($e);
            return '';
        }
    }

    private function resize($params) {

        if(isset($params['resize'])) {
            $resizeList = $params['resize'];
            foreach($resizeList as $resize) {
                $demension = explode('x', $resize);
                $resizeWith = $demension[0];
                $resizeHeight = $demension[1];
                $resizeDir = $this->uploadDir  . '/' . $resizeWith . 'x' . $resizeHeight;

                if(!is_null($resizeDir) && !file_exists($resizeDir)) {
                    File::makeDirectory($resizeDir, 0755, true, true);
                }

                $image = request()->file($this->fieldName);
        
                $img = Image::make($image->path());

                $img->resize($resizeWith, $resizeHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($resizeDir . '/' . $image->hashName());
            }
        }
    }
}