<?php
namespace Cms\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class UploadFile
{

    protected $uploadDir = '/cms/upload';
    protected $fieldName = 'upload_file';
    protected $deleteImageName = 'delete_image_ids';
    protected $resizeDir = null;
    protected $resizeWidth = null;
    protected $resizeHeight = null;
    protected $output = [];

    static $resize = [
        'image_product' => [
            'small' => ['width' => 50, 'height' => 50],
            'medium' => ['width' => 160, 'height' => 160],
        ],
    ];

    public function __construct()
    {
        $this->output = [];
    }

    public function upload($params = [])
    {
        try {
            if (request()->has($this->fieldName)) {
                $files = request()->file($this->fieldName);
                $imageDeleted = request()->input($this->deleteImageName, []);

                foreach ($files as $folder => $file) {

                    if (is_array($file)) {
                        foreach ($file as $index => $myFile) {
                            $originName = $myFile->getClientOriginalName();

                            if (in_array($originName, $imageDeleted)) {
                                continue;
                            }

                            $filename = $myFile->hashName();

                            $uploadDir = $this->uploadDir . '/' . $folder;

                            $resizeResult = $this->resize($myFile, $folder);

                            $uploadPath = public_path($uploadDir);
                            if (!File::exists($uploadPath)) {
                                File::makeDirectory($uploadPath, 0755, true, true);
                            }

                            $myFile->move($uploadPath, $filename);

                            $this->output[$index]['image'] = $uploadDir . '/' . $filename;
                            $this->output[$index]['resize'] = $resizeResult;
                        }

                        return $this;
                    }
                }
            }

            return $this;

        } catch (\Exception $e) {
            Log::info($e);
            return $this;
        }
    }

    public function resize($image, $folder)
    {

        $output = [];

        if (isset(self::$resize[$folder])) {

            $uploadDir = $this->uploadDir;
            if (!is_numeric($folder)) {
                $uploadDir = $uploadDir . '/' . $folder;
            }

            $resizeList = self::$resize[$folder];
            foreach ($resizeList as $resize) {
                $resizeWith = $resize['width'];
                $resizeHeight = $resize['height'];

                $resizeSaveDir = $uploadDir . '/' . $resizeWith . 'x' . $resizeHeight;
                $resizeDir = public_path($resizeSaveDir);

                if (!is_null($resizeDir) && !file_exists($resizeDir)) {
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

    public function first()
    {
        $first = array_key_first($this->output);
        return count($this->output) ? $this->output[$first]['image'] : '';
    }

    public function all()
    {
        return count($this->output) ? $this->output : [];
    }
}
