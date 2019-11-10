<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
        $rules = [];
        foreach ($this->request->get('start') ?? [] as $key => $val) {
            $rules["start.{$key}"] = "min:0|max:23|lt:end.{$key}|integer";
            $rules["end.{$key}"] = "min:0|max:23|gt:start.{$key}|integer";
        }

        return $rules;
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        $messages = [];

        foreach ($this->request->get('start') ?? [] as $key => $val) {
            $messages["start.{$key}.min"] = "You must enter a number greater than 0";
            $messages["start.{$key}.max"] = "You must enter a number less than 24";
            $messages["start.{$key}.lt"] = "You must enter a number less than the end time";
            $messages["start.{$key}.integer"] = "You must enter a valid number from 0 - 23";

            $messages["end.{$key}.min"] = "You must enter a number greater than 0";
            $messages["end.{$key}.max"] = "You must enter a number less than 24";
            $messages["end.{$key}.gt"] = "You must enter a number greater than the start time";
            $messages["end.{$key}.integer"] = "You must enter a valid number from 0 - 23";
        }


        return $messages;
    }
}
