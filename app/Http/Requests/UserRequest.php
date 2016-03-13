<?php

namespace App\Http\Requests;

use App\User;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->isMethod('POST')) {
            $user = User::findOrFail($this->route('id'));

            return $this->user()->can('update', $user);
        }

        return $this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Se necesita saber si el usuario esta o no actualizando algun recurso
        // es por eso que se chequea si el metodo del formulario es patch
        // o put (actualizacion), de ser asi se necesita cambiar un
        // poco las reglas para permitir que los campos unicos
        // se repitan solo para ese usuario, es decir
        // name => required: excepto si mismo.
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                    'name'     => 'required|max:20|alpha-dash|unique:users,name,' . (int)$this->route('id'),
                    'email'    => 'required|email|max:255|unique:users,email,' . (int)$this->route('id'),
                    'password' => 'confirmed|min:6',
                ];
            default:
                return [
                    'name'     => 'required|max:20|alpha-dash|unique:users',
                    'email'    => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                ];
        }
    }
}
