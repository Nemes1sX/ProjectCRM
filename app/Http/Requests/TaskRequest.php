<?php

namespace App\Http\Requests;

use App\Rules\ProjectDate;
use Illuminate\Foundation\Http\FormRequest;


class TaskRequest extends FormRequest
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
            'name' => 'required|max:40',
            'description' => 'required|max:40',
            'startdate' => 'required|date',
            //'enddate' => ['required' ,'date', 'after_or_equal:startdate', new ProjectDate($request->all())],
            'enddate' => 'required|date|after_or_equal:startdate',
        ];
    }
}
