<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|max:100|regex:/^[a-zA-Z\s]*$/',
            'address' => 'required|max:300|regex:/^[a-zA-Z0-9,. \t\r\n\-]+$/',
        ];
    }
}
