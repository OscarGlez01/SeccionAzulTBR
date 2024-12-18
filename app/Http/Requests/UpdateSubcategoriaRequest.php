<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoriaRequest extends StoreSubcategoriaRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();

         // Adjust 'name' rule to exclude the current record
         $rules['nombre'] = 'sometimes|string|max:255|unique:subcategorias,nombre,' . $this->route('subcategoria')->subcategoria_id . ',subcategoria_id';

        return $rules;
    }
    
    public function messages()
    {
        $messages = parent::messages();

        return $messages;
    }
}
