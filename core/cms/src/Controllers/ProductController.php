<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Category;
use Cms\Models\ImageProduct;
use Cms\Models\Product;
use Cms\Models\ProductTag;
use Cms\Models\Vendor;
use Cms\Requests\ProductRequest;

class ProductController extends AppController
{

    public function save(ProductRequest $request, Product $product)
    {

        if ($request->isMethod('post')) {
            $params = $request->all();
            // Create product
            $product->name = $request->input('name');
            $product->name_url = $this->slugName($product->name);
            $product->price = $request->input('price', 'Liên hệ');
            $product->category_id = $request->input('category_id', 0);
            $product->vendor_id = $request->input('vendor_id', 0);
            $product->description = $request->input('description');
            $product->summary = $request->input('summary');
            $product->discount = $request->input('discount');
            $product->avail_flg = $request->avail_flg == 'on' ? 1 : 0;
            $product->is_new = $request->input('is_new', 1);
            $product->is_popular = $request->input('is_popular', 1);
            $product->is_best_selling = $request->input('is_best_selling', 1);
            $product->seo_keywords = $request->has('seo_keywords') ? $request->input('seo_keywords') : $request->input('name');
            $product->seo_description = $request->has('seo_description') ? $request->input('seo_description') : $request->input('name');
            $product->status = $request->status == 'on' ? 1 : 0;
            $tags = $request->input('tags');
            if ($tags && count($tags)) {
                $product->tags = implode(',', $tags);
            }

            $product->save();

            if ($product->exists) {

                // Image Products
                $resultUpload = $this->uploadFile->upload()->all();
                if (count($resultUpload)) {
                    foreach ($resultUpload as $result) {
                        $imagesProduct = new ImageProduct();

                        $imagesProduct->image = $result['image'];
                        $imagesProduct->small = $result['small'];
                        $imagesProduct->medium = $result['medium'];
                        $imagesProduct->is_main = 0;

                        $product->imagesProduct()->save($imagesProduct);
                    }
                }

                // Remove images
                if ($request->has('delete_image_ids')) {
                    $ids = array_filter($request->delete_image_ids, function ($v, $k) {
                        return is_numeric($v);
                    }, ARRAY_FILTER_USE_BOTH);

                    $product->imagesProduct()->whereIn('id', $ids)->delete();
                }

                $message = trans('cms::auth.message.update_success');
            }

            return redirect()->route('auth.product.list')->with('success', $message);
        }

        $categories = Category::query()->with('childCategories')->active()->where('parent_id', null)->get();
        $vendors = Vendor::query()->active()->get();
        $tags = ProductTag::query()->active()->get();
        return view('cms::auth.pages.product.form', compact('product', 'categories', 'vendors', 'tags'));
    }
}
