<?php

namespace App\Http\Requests;

use App\Project;
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
        $project = Project::find(request('project_id'));

        return [
            'name' => 'required|max:40',
            'description' => 'required|max:40',
            'startdate' => 'required|date|after_or_equal:'.$project->startdate->format('Y-m-d'),
            'enddate' => 'required|date|after_or_equal:startdate|before_or_equal:'.$project->enddate->format('Y-m-d'),
        ];
    }
}
