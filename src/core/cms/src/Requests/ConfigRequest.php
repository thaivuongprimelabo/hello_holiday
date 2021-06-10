<?php

namespace Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'web_title' => 'required',
            'upload_file.web_logo' => 'max:200|mimes:png,jpg,jpeg',
            'upload_file.web_ico' => 'max:200|mimes:png,jpg,jpeg',
            'upload_file.web_banner' => 'max:500|mimes:png,jpg,jpeg'
        ];

        return $rules;
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
