<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashierRequest extends FormRequest
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
          'cedula' => 'required|regex:/^[0-9]+$/',
          'nombre' => 'required|regex:/^[a-zñA-ZÑáéíóúÁÉÍÓÚ\s]+$/',
          'apellido' => 'required|regex:/^[a-zñA-ZÑáéíóúÁÉÍÓÚ\s]+$/',
          'telefono' => 'required|regex:/^[0-9]+$/',
          'email' => 'required|regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
          'direccion' => 'required',
          'password' => 'required',
      ];
    }
    public function messages()
    {
        return [
          'required' => 'El campo es obligatorio.',
          'cedula.regex' => 'Solo se aceptan numeros.',
          'nombre.regex' =>'Puede utilizar solo letras y espacios.',
          'apellido.regex' =>'Puede utilizar solo letras y espacios.',
          'telefono.regex' =>'Solo acepta numeros.',
          'email.regex' => 'Ingrese una direccion de correo valida.',
          'password.regex' => 'Ingrese una contraseña de al menos 8 caracteres.',
        ];
    }
}
