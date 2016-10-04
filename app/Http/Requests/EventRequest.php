<?php

namespace App\Http\Requests;

class EventRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'institute_id' => 'required|int|exists:institutes,id',
            'name'         => $this->getNameRules(),
            'hours'        => 'required|int|min:1',
            'date'         => 'date',
            'location'     => 'string|no_uppercase',
            'info'         => 'string|no_uppercase',
        ];
    }

    /**
     * Determina cuales reglas deben ser aplicadas al nombre
     *
     * @return string
     */
    private function getNameRules()
    {
        $rules = 'required|string|no_uppercase|between:3,250|unique_with:events,date';

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return $rules . ',' . $this->route('id');
            default:
                return $rules;
        }
    }
}
