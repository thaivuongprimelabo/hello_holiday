<?php

namespace Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:32|confirmed',
            'password_confirmation' => 'required|min:8|max:32',
            'upload_file.avatar.*' => 'max:' . \Cms\Constants::formatMemory(session('config')->max_upload_list['avatar']) . '|mimes:png,jpg,jpeg'
        ];

        $user = $this->route('user');
        if($user && $user->exists) {
            unset($rules['email']);
            $rules['password'] = 'max:32|confirmed';
            $rules['password_confirmation'] = 'max:32';
        }

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
