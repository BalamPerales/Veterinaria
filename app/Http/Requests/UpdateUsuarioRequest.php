<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
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
        // Obtener el ID del usuario de la ruta (asumiendo que el parámetro se llama 'usuario')
        $userId = $this->route('usuario')->id ?? $this->route('usuario');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', Rule::in(['administrador', 'veterinario'])],
        ];

        // Validación adicional si el rol es veterinario
        if ($this->rol === 'veterinario') {
            $rules['especialidad'] = ['nullable', 'string', 'max:255'];
            $rules['cedula_profesional'] = ['nullable', 'string', 'max:100'];
            $rules['foto_firma'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre completo es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado en otro usuario.',
            
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            
            'rol.required' => 'Debe seleccionar un rol para el usuario.',
            'rol.in' => 'El rol seleccionado no es válido.',
            
            'especialidad.max' => 'La especialidad no debe superar los 255 caracteres.',
            
            'cedula_profesional.max' => 'La cédula profesional no debe superar los 100 caracteres.',
            
            'foto_firma.image' => 'El archivo subido debe ser una imagen.',
            'foto_firma.mimes' => 'La imagen de la firma debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'foto_firma.max' => 'La imagen de la firma no debe pesar más de 2MB.',
        ];
    }
}
