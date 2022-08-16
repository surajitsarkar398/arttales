<?php

namespace App\Http\Request\Artist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;

class ArtistFormRequest extends FormRequest
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
            'genres' => 'required',
            'major_achivement' => 'required',
            'work_at'      => 'required',
            'performance'     => 'required',
            'category'  => 'required',
            'subcategory'       => 'required',
            'role'          => 'required',
            'description'     => 'required',
        ];
    }


}
