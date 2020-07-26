<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class AdminRequest extends FormRequest
{
    use SanitizesInput;

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
     *  Validation rules to be applied to the input.
     *
     *  @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
            return [];
            case 'POST':
            return [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required|min:5|max:255',
                'username' => 'required|unique:admins|min:5|max:255',
                'password' => 'required|min:6|max:255',
            ];
            case 'PUT':
            case 'PATCH':
            return [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required|min:5|max:255',
                'username' => 'required|min:5|max:255|unique:admins,username,' . $this->data->id,
            ];
            default: break;
        }
    }

    /**
     *  Filters to be applied to the input.
     *
     *  @return array
     */
    public function filters()
    {
        return [
            'name' => 'trim|escape|capitalize',
            'username' => 'trim|escape|lowercase',
        ];
    }
}
