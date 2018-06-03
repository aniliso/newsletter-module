<?php

namespace Modules\Newsletter\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateSubscriberRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'newsletter::subscribers.form';

    public function rules()
    {
        return [
            'email' => 'required',
            'name'  => 'required'
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
