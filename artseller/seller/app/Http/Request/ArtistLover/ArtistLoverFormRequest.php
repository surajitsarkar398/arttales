<?php

namespace App\Http\Request\ArtistLover;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;

class ArtistLoverFormRequest extends FormRequest
{
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
        return [
            'name' => 'required',
            'email'  => 'required|email|unique:users',
            'mobile' => 'required',
            'country_code' => 'required',
            'website' => 'required',
            'image' =>      'required',
            'password' => 'required|min:6',
            'repassword' => 'required',
            'role'          => 'required',
            'description'     => 'required',
        ];
    }


}
