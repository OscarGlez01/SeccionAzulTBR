<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNegocioRequest extends StoreNegocioRequest
{
    /**
     * Summary of rules
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();

        // Adjust 'name' rule to exclude the current record
        $rules['nombre'] = 'sometimes|required|string|max:255';
        $rules['categoria_id'] = 'nullable|exists:categorias,categoria_id';
        $rules['estado'] = 'sometimes|required|in:activo,inactivo';


        return $rules;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'telefono' => $this->sanitizePhoneNumber($this->telefono),
            'whatsapp' => $this->sanitizePhoneNumber($this->whatsapp),
            'nombre' => trim($this->nombre),
        ]);
    }

    public function messages()
    {
        $messages = parent::messages();

        return $messages;
    }

    private function sanitizePhoneNumber($number)
    {
        return $number ? preg_replace('/\D/', '', $number) : null;
    }
}
