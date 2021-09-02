<?php

namespace Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

        $order = $this->route('order');

        if (!is_null($order)) {
            $rules = [
                'status' => 'required'
            ];
        } else {
            $rules = [
                //
                'customer_name' => 'required',
                'customer_address' => 'required',
                'customer_phone' => 'required',
                'customer_province' => 'required',
                'customer_district' => 'required',
                'customer_block' => 'required',
                'payment_method' => 'required',
                'status' => 'required',
            ];
        }

        return $rules;
    }

    public function validator($factory)
    {
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
