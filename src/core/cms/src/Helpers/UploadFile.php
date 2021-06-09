<?php
namespace Cms\Helpers;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UploadFile {

    protected $uploadDir = '/cms/upload';
    protected $fieldName = 'upload_file';
    protected $deleteImageName = 'delete_image_ids';
    protected $resizeDir = null;
    protected $resizeWidth = null;
    protected $resizeHeight = null;
    protected $output = [];

    public function upload($params = []) {
        try {
            if(request()->has($this->fieldName)) {
                $file = request()->file($this->fieldName);
                $imageDeleted = request()->input($this->deleteImageName, []);

                $arrFiles = [];
                if(!is_array($file)) {
                    $arrFiles[] = $file;
                } else {
                    $arrFiles = $file;
                }

                foreach($arrFiles as $key=>$f) {
                    $originName = $f->getClientOriginalName();
                    
                    if(in_array($originName, $imageDeleted)) {
                        continue;
                    }

                    $filename = $f->hashName();
            
                    $uploadDir   = $this->uploadDir;
                    if(isset($params['dir'])) {
                        $uploadDir = $uploadDir . '/' . $params['dir'];
                    }

                    $resizeResult = $this->resize($params, $f);

                    $uploadPath = public_path($uploadDir);
                    if(!File::exists($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true, true);
                    }

                    $f->move($uploadPath, $filename);

                    $this->output[$key]['image'] = $uploadDir . '/' . $filename;
                    $this->output[$key]['resize'] = $resizeResult;
                }
            }

            return $this;

        } catch(\Exception $e) {
            Log::info($e);
            return $this;
        }
    }

    private function resize($params, $image) {

        $output = [];

        if(isset($params['resize'])) {

            $uploadDir = $this->uploadDir;
            if(isset($params['dir'])) {
                $uploadDir = $uploadDir . '/' . $params['dir'];
            }

            $resizeList = $params['resize'];
            foreach($resizeList as $resize) {
                $demension = explode('x', $resize);
                $resizeWith = $demension[0];
                $resizeHeight = $demension[1];

                $resizeSaveDir = $uploadDir . '/' . $resizeWith . 'x' . $resizeHeight;
                $resizeDir = public_path($resizeSaveDir);
                
                if(!is_null($resizeDir) && !file_exists($resizeDir)) {
                    File::makeDirectory($resizeDir, 0755, true, true);
                }

                $img = Image::make($image->path());

                $img->resize($resizeWith, $resizeHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($resizeDir . '/' . $image->hashName());

                $output[] = $resizeSaveDir . '/' . $image->hashName();
            }
        }

        return $output;
    }

    public function first() {
        return count($this->output) ? $this->output[0]['image'] : '';
    }

    public function all() {
        return count($this->output) ? $this->output : [];
    }
}