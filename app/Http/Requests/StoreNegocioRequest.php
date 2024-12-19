<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNegocioRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'telefono' => 'nullable|digits_between:10,15',
            'whatsapp' => 'nullable|regex:/^\+?\d{10,15}$/',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'horarios' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'categoria_id' => 'required|exists:categorias,categoria_id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'telefono' => $this->sanitizePhoneNumber($this->telefono),
            'whatsapp' => $this->sanitizePhoneNumber($this->whatsapp),
            'estado' => $this->estado ?? 'inactivo', // Set default value if not provided.
            'imagen' => $this->imagen ? trim($this->imagen) : null,
        ]);
    }

    /**
     * Helper function to sanitize phone numbers.
     */
    private function sanitizePhoneNumber($number)
    {
        return $number ? preg_replace('/\D/', '', $number) : null;
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo "nombre" es obligatorio.',
            'telefono.digits_between' => 'El teléfono debe tener entre 10 y 15 dígitos.',
            'whatsapp.regex' => 'El número de WhatsApp debe tener un formato válido.',
            'facebook.url' => 'El enlace de Facebook debe ser una URL válida.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
        ];
    }
}
