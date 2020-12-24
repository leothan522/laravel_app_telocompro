<?php

namespace App\Http\Requests\Android;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FacturacionEnvioRequest extends FormRequest
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
            'cedula' => ['required', 'min:6', Rule::unique('clientes')->ignore(Auth::user()->id, 'users_id'),],
            'nombre' => 'required|min:3',
            'apellidos' => 'required|min:4',
            'direccion_1' => 'required|min:5',
            'localidad' => 'required|min:5'
        ];
    }
}
