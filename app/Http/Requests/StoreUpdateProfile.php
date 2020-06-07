<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProfile extends FormRequest
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
        $id = $this->segment(3);
        return [
            'name'          => "required|min:3|max:255|unique:profiles,name,{$id},id",
            'description'   => 'required|min:3|max:255',
        ];
    }
    
    public function messages() 
    {
        return [
            'name.required'         => 'O campo nome é obrigatório',
            'name.min'              => 'O campo nome deve conter pelomenos 3 caracteres',
            'description.required'  => 'O campo descrição é obrigatório',
            'description.min'       => 'O campo descrição deve conter pelomenos 3 caracteres',
        ];
    }
}
