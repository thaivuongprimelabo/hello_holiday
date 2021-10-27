<?php

namespace Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:255',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => 'Tối đã :max ký tự'
        ];
    }

    public function attributes()
    {
        $attributes = [
            'name' => 'tên loại sản phẩm',
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
