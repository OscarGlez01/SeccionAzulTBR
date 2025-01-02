<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class StoreCategoriaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'logo' => 'nullable|string'
        ];
    }

    /**
     * Input normalization for categoria, it trims white spaces and limit characters up to validation
     * @return void // no need to return anything as the request entity handles the work
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'nombre' => Str::limit(ucwords(trim($this->input('nombre'))), 255, ''),
            'descripcion' => Str::limit(strip_tags(trim($this->input('descripcion'))), 500, ''),
            'banner' => $this->file('banner'),
            'logo' => Str::limit($this->input('logo'), 255, '')
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
