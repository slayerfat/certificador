<?php

namespace App\Http\Requests;

class PersonalDetailsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isOwnerOrAdmin($this->route('userID'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // validacion de fecha, por ahora es de 10 años o antes
        $date = date('Y-m-d', strtotime('-18 year'));

        // Se necesita saber si el usuario esta o no actualizando algun recurso
        // es por eso que se chequea si el metodo del formulario es patch
        // o put (actualizacion), de ser asi se necesita cambiar un
        // poco las reglas para permitir que los campos unicos
        // se repitan solo para ese usuario, es decir
        // name => required: excepto si mismo.
        $array = [
            'first_name'    => 'required|regex:/^[a-zA-Z-_áéíóúÁÉÍÓÚÑñ\']+$/|min:3|max:20',
            'last_name'     => 'regex:/^[a-zA-Z-_áéíóúÁÉÍÓÚÑñ\']+$/|min:3|max:20',
            'first_surname' => 'required|regex:/^[a-zA-Z-_áéíóúÁÉÍÓÚÑñ\']+$/|min:3|max:20',
            'last_surname'  => 'regex:/^[a-zA-Z-_áéíóúÁÉÍÓÚÑñ\']+$/|min:3|max:20',
            'phone'         => 'required|between:11,11|regex:/^[0-9]+$/',
            'cellphone'     => 'between:11,11|regex:/^[0-9]+$/',
            'birthday'      => "required|date|before:$date",
            'title_id'      => 'required|numeric|exists:titles,id',
            'sex'           => 'required|string|max:1',
        ];

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return array_merge($array, [
                    'ci' => 'required|numeric|between:999999,99999999|unique:personal_details,ci,'
                        . (int)$this->route('id'),
                ]);
            default:
                return array_merge($array, [
                    'ci' => 'required|numeric|between:999999,99999999|unique:personal_details',
                ]);
        }
    }
}
