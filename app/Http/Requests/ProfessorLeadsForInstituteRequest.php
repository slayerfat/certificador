<?php

namespace App\Http\Requests;

class ProfessorLeadsForInstituteRequest extends Request
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
            'professors' => 'required',
            'position'   => 'string|between:5,250|no_uppercase',
        ];
    }
}
