<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Vendor;
use Cms\Requests\VendorRequest;

class VendorController extends AppController
{

    public function save(VendorRequest $request, Vendor $vendor)
    {
        if ($request->isMethod('post')) {

            $vendor->name = $request->name;
            $vendor->name_url = $this->slugName($vendor->name);

            $resultUpload = $this->uploadFile->singleUpload('logo');

            if (!empty($resultUpload)) {
                $vendor->logo = $resultUpload;
            }

            $vendor->status = !is_null($request->status) ? 1 : 0;
            $vendor->save();

            if ($vendor->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.vendor.list')->with('success', $message);
        }
        return view('cms::auth.pages.vendor.form', compact('vendor'));
    }
}
