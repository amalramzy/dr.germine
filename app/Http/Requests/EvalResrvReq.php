<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvalResrvReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "reservation_id"=>'required|exists:reservations,id',
            "evaluations"=>'array|min:1',
            "evaluations.*.question_id"=>'required|exists:evaluations,id',
            "evaluations.*.score"=>'integer|max:5|min:0'
        ];
    }
}
