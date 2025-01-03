<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreSubcategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:subcategorias,nombre',
            'descripcion' => 'nullable|string|max:500',
            'categoria_id' => 'nullable|exists:categorias,categoria_id'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'nombre' => Str::limit((ucwords(trim($this->input('nombre')))), 255, ''),
            'descripcion' => Str::limit(strip_tags(trim($this->input('descripcion'))), 500, ''),
        ]);
    }


    /**
     * Messages for failed or cancelled validations
     * @return string[]
     */
    public function messages()
    {
        return [
            'nombre.unique' => 'El nombre debe ser único. Este nombre esta registrado en la base de datos'
        ];
    }

}
