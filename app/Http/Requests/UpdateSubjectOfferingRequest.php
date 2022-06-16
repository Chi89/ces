<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectOfferingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'course_id' => 'required',
            'subject_id' => 'required',
            'school_year' => 'required|numeric',
            'year_level' => 'required|numeric',
            'section' =>  [
                'required', 
                    Rule::unique("subject_offerings")->where(
                        function ($query) {
                            return $query->where([
                                ["course_id", "=", $this->course_id],
                                ["subject_id", "=", $this->subject_id],
                                ["school_year", "=", $this->school_year],
                                ["year_level", "=", $this->year_level],
                                ["section", "=", $this->section],
                                ["id", "<>", $this->id]
                            ]);
                        }
                    )
                ],
        ];
    }
}
