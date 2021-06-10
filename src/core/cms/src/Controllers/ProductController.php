<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Product;
use Cms\Models\Category;
use Cms\Models\Vendor;
use Cms\Models\ImageProduct;
use Cms\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Cms\Controllers\AppController;

class ProductController extends AppController
{

    public function save(ProductRequest $request, Product $product) {

        if($request->isMethod('post')) {

            // Create product
            $product->name              = $request->input('name');
            $product->name_url          = Str::of($request->name)->slug('-');
            $product->price             = $request->input('price', 'Liên hệ');
            $product->category_id       = $request->input('category_id', 0);
            $product->vendor_id         = $request->input('vendor_id', 0);
            $product->description       = $request->input('description');
            $product->summary           = $request->input('summary');
            $product->discount          = $request->input('discount');
            $product->is_new            = $request->input('is_new', 1);
            $product->is_popular        = $request->input('is_popular', 1);
            $product->is_best_selling   = $request->input('is_best_selling', 1);
            $product->seo_keywords      = $request->input('seo_keywords');
            $product->seo_description   = $request->input('seo_description');
            $product->status            = !is_null($request->status) ? 1 : 0;
            $product->save();

            if($product->exists) {

                // Image Products
                $resultUpload = $this->uploadFile->upload($this->uploadSetting)->all();
                if(count($resultUpload)) {
                    foreach($resultUpload as $result) {
                        $imagesProduct = new ImageProduct();

                        $imagesProduct->image = $result['image'];
                        $imagesProduct->small = $result['resize'][0];
                        $imagesProduct->medium = $result['resize'][1];
                        $imagesProduct->is_main = 0;

                        $product->imagesProduct()->save($imagesProduct);
                    }
                }

                // Remove images
                if($request->has('delete_image_ids')) {
                    $ids = array_filter($request->delete_image_ids, function($v, $k) {
                        return is_numeric($v);
                    }, ARRAY_FILTER_USE_BOTH);

                    $product->imagesProduct()->whereIn('id', $ids)->delete();
                }
                
                $message = trans('cms::auth.message.update_success');
            }

            return redirect()->route('auth.product.list')->with('success', $message);
        }

        $categories = Category::query()->active()->get();
        $vendors = Vendor::query()->active()->get();
        return view('cms::auth.pages.product.form', compact('product', 'categories', 'vendors'));
    }
}