<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends StoreCategoriaRequest
{
    // We can extend our Store Request if the validation is the same.
    public function rules(): array
    {
        $rules = parent::rules(); // Inherit rules from StoreRequest

        // Adjust 'name' rule to exclude the current record
        $rules['nombre'] = 'sometimes|string|max:255|unique:categorias,nombre,' . $this->route('id_categoria');

        return $rules;
    }

    public function messages()
    {
        $messages = parent::messages();

        return $messages;
    }
}
