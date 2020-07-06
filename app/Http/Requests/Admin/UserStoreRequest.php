<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class UserStoreRequest extends FormRequest
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
        return [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sin' => 'required|integer|unique:users',
            'name' => 'required|min:5|max:255',
            'password' => 'nullable|min:6|max:255',
            'birth_place' => 'required|min:5|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'in:Laki - Laki, Perempuan',
            'address' => 'nullable|min:5',
            'religion' => 'in:Islam,Protestan,Katolik,Hindu,Buddha',
            'marital_status' => 'in:Belum Kawin,Kawin',
            'profession' => 'required|min:5|max:255',
        ];
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