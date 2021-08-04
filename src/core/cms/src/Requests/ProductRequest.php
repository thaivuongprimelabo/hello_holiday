<?php

namespace Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;


class ProductRequest extends FormRequest
{
    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->current(); 
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            //
            'name' => 'required|max:200',
            'seo_keywords' => 'max:300',
            'seo_description' => 'max:300',
            'upload_file.image_product.*' => 'max:' . \Cms\Constants::formatMemory(session('config')->max_upload_list['image_product'], true) . '|mimes:png,jpg,jpeg'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':attribute đã được sử dụng',
            'max' => 'Tối đã :max ký tự'
        ];
    }

    public function attributes()
    {
        $attributes = [
            'name' => 'Tên sản phẩm',
            'category_id' => 'Loại sản phẩm',
            'vendor_id' => 'Nhà cung cấp',
        ];

        return $attributes;
    }

    public function validator($factory) {
        if ($this->isReading() || request()->has('action')) {
            return $factory->make(
                $this->validationData(), [],
                $this->messages(), $this->attributes()
            );
        } else {
            return $this->createDefaultValidator($factory);
        }
    }

    /**
     * Determine if the HTTP request uses a ‘read’ verb.
     *
     * @return bool
     */
    protected function isReading()
    {
        return in_array(request()->method(), ['HEAD', 'GET', 'OPTIONS']);
    }
}
