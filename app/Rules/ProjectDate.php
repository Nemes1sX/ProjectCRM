<?php

namespace App\Rules;

use App\Project;
use Illuminate\Contracts\Validation\Rule;

class ProjectDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     *
     *
     *
     */
    private $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = Project::find($value->id)->enddate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can`t set task enddate after project`s end date';
    }
}
