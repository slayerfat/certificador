<?php

namespace App\Http\Requests;

use App\PersonalDetail;
use App\Professor;

class ProfessorRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var PersonalDetail $details */
        if ($this->method == 'POST') {
            $details = PersonalDetail::findOrFail($this->route('personalDetailsID'));
        } elseif ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $details = Professor::findOrFail($this->route('id'))->load('personalDetails');
        }

        return $this->user()->isOwnerOrAdmin($details->user_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @see App\Http\Requests\UserRequest
     * @return array
     */
    public function rules()
    {
        return [
            'title_id' => 'required|numeric|exists:titles,id',
            'position' => 'string|between:5,250',
        ];
    }
}
