<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'cpf' => 'required|max:11|unique:users',
            'telephone' => 'required|max:11',
        ];
    }

    public function validationData()
    {
        $data = $this->all();
        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
        $data['telephone'] = preg_replace('/[^0-9]/', '', $data['telephone']);
        return $data;
    }
}
