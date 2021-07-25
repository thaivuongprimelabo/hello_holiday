<?php
namespace Cms\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class UploadFile
{

    protected $uploadDir = '/upload';
    protected $fieldName = 'upload_file';
    protected $deleteImageName = 'delete_image_ids';
    protected $resizeDir = null;
    protected $resizeWidth = null;
    protected $resizeHeight = null;
    protected $output = [];
    protected $resizeOutput = [];

    static $resize = [
        'image_product' => ['width_small' => '80x80', 'width_medium' => '200x200'],
    ];

    public function upload($params = [])
    {
        $this->output = [];

        try {
            if (request()->has($this->fieldName)) {
                
                $fileRequest = request()->file($this->fieldName);
                $imageDeleted = request()->input($this->deleteImageName, []);

                $folder = array_keys($fileRequest)[0];
                $files = $fileRequest[$folder];
                

                foreach ($files as $index => $file) {
                    $originName = $file->getClientOriginalName();

                    if (in_array($originName, $imageDeleted)) {
                        continue;
                    }

                    $filename = $file->hashName();

                    $uploadDir = $this->uploadDir . '/' . $folder;

                    // Resize image
                    if (isset(self::$resize[$folder])) {

                        if (isset(self::$resize[$folder]['width_small'])) {
                            $widthHeight = self::$resize[$folder]['width_small'];
                            $dir = $uploadDir . '/' . $widthHeight;

                            if (!File::exists(public_path($dir))) {
                                File::makeDirectory(public_path($dir), 0755, true, true);
                            }

                            $img = Image::make($file->path());
                            $demension = explode('x', $widthHeight);
                            $dirSave = $dir . '/' . $filename;

                            $img->resize($demension[0], $demension[1], function ($constraint) {
                                $constraint->aspectRatio();
                            })->save(public_path($dirSave));

                            $this->output[$folder][$index]['small'] = $dirSave;
                        }

                        if (isset(self::$resize[$folder]['width_medium'])) {
                            $widthHeight = self::$resize[$folder]['width_medium'];
                            $dir = $uploadDir . '/' . $widthHeight;

                            if (!File::exists(public_path($dir))) {
                                File::makeDirectory(public_path($dir), 0755, true, true);
                            }

                            $img = Image::make($file->path());
                            $demension = explode('x', $widthHeight);
                            $dirSave = $dir . '/' . $filename;

                            $img->resize($demension[0], $demension[1], function ($constraint) {
                                $constraint->aspectRatio();
                            })->save(public_path($dirSave));

                            $this->output[$folder][$index]['medium'] = $dirSave;
                        }
                        
                    }

                    if (!File::exists(public_path($uploadDir))) {
                        File::makeDirectory(public_path($uploadDir), 0755, true, true);
                    }

                    $pathinfo = $file->move(public_path($uploadDir), $filename);
                    $pathName = str_replace(public_path(), '', $pathinfo->getPathName());
                    $this->output[$folder][$index]['image'] = $pathName;
                }

                return $this;
            }

            return $this;

        } catch (\Exception $e) {
            Log::info($e);
            return $this;
        }
    }

    public function singleUpload($folder)
    {
        try {
            $file = $this->fieldName  . '.' . $folder . '.0';
            if (request()->has($file)) {
                $file = request()->file($file);
                $filename = $file->hashName();
                $uploadDir = $this->uploadDir . '/' . $folder;
                $pathinfo = $file->move(public_path($uploadDir), $filename);
                $pathName = str_replace(public_path(), '', $pathinfo->getPathName());
                return $pathName;
            }
        } catch(\Exception $e) {
            Log::info($e);
        }
        
        return '';
    }

    public function resize($widthHeight, $folder)
    {

        try {
            $file = $this->fieldName  . '.' . $folder . '.0';;
            if (request()->has($file)) {
                $file = request()->file($file);

                $filename = $file->hashName();

                $uploadDir = $this->uploadDir . '/' . $folder;
                
                // Resize image
                $dir = $uploadDir . '/' . $widthHeight;

                if (!File::exists(public_path($dir))) {
                    File::makeDirectory(public_path($dir), 0755, true, true);
                }

                $img = Image::make($file->path());
                $demension = explode('x', $widthHeight);
                $dirSave = $dir . '/' . $filename;

                $img->resize($demension[0], $demension[1], function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($dirSave));

                return $dirSave;
            }

        } catch (\Exception $e) {
            Log::info($e);
        }
        return '';
    }

    public function first($folder = '')
    {
        $folder = !empty($folder) ? $folder : array_key_first($this->output);
        return isset($this->output[$folder]) && count($this->output[$folder]) ? $this->output[$folder][0]['image'] : '';
    }

    public function all($folder = '')
    {
        $folder = !empty($folder) ? $folder : array_key_first($this->output);
        return isset($this->output[$folder]) && count($this->output[$folder]) ? $this->output[$folder] : [];
    }
}
