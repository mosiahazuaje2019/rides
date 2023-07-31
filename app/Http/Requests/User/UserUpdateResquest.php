<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateResquest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'profile' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Debe ingresar un nombre',
            'last_name.required' => 'Debe ingresar un apellido',
            'phone.required' => 'Debe registrar un numero de teléfono',
            'email.required' => 'Debe registrar un correo electrónico',
            'profile.required' => 'Debe seleccionar el perfil'
        ];
    }
}
