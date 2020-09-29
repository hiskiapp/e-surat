<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class UserRequest extends FormRequest
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
                'sin' => 'required|integer|unique:users',
                'name' => 'required|min:5|max:255',
                'password' => 'nullable|min:6|max:255',
                'birth_place' => 'required|min:5|max:255',
                'birth_date' => 'nullable|date',
                'gender' => 'in:Laki - Laki,Perempuan',
                'address' => 'nullable|min:5',
                'religion' => 'in:Islam,Protestan,Katolik,Hindu,Buddha',
                'marital_status' => 'in:Belum Kawin,Kawin',
                'profession' => 'required|min:5|max:255',
                'phone_number' => 'nullable'
            ];
            case 'PUT':
            case 'PATCH':
            return [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sin' => 'required|integer|unique:users,sin,' . $this->user->id,
                'name' => 'required|min:5|max:255',
                'password' => 'nullable|min:6|max:255',
                'birth_place' => 'required|min:5|max:255',
                'birth_date' => 'nullable|date',
                'gender' => 'in:Laki - Laki,Perempuan',
                'address' => 'nullable|min:5',
                'religion' => 'in:Islam,Protestan,Katolik,Hindu,Buddha',
                'marital_status' => 'in:Belum Kawin,Kawin',
                'profession' => 'required|min:5|max:255',
                'phone_number' => 'nullable'
            ];
            default:break;
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
            'birth_place' => 'trim|escape|capitalize',
            'profession' => 'trim|escape|capitalize',
        ];
    }
}
