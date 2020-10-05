<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubsidiaryRequest extends FormRequest
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
          'nombre'=> 'required|regex:/^[a-zñA-ZÑ0-9\s.-]+$/',
          'telefono' => 'required|regex:/^[0-9]+$/',
          'direccion' => 'required',
          'email' => 'required|regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
          'password' => 'required',
          'logo' => 'required|mimes:jpeg,jpg,png,gif',
      ];
    }
    public function messages()
    {
        return [
          'required' => 'El campo es obligatorio.',
          'nombre.regex' =>'Puede utilizar solo letras, numeros, guiones, puntos y espacios.',
          'telefono.regex' =>'Solo acepta numeros.',
          'email.regex' => 'Ingrese una direccion de correo valida.',
          'password.regex' => 'Ingrese una contraseña de al menos 8 caracteres.',
          'image.mimes' => 'Formato de imagen debe ser JPEG, JPG, PNG o GIF.', 
        ];
    }
}
