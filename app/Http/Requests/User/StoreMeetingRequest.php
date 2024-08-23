<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends BaseUserRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'required|string|unique:meetings,name',
            'welcome_message' => 'required|string',
            'password' => 'nullable|min:8',
            'max_participants' => 'nullable|numeric',
            'is_scheduled' => 'nullable|in:on,off',
            'start_date' => 'required_if:is_scheduled,on|date|after_or_equal:today',
            'end_date' => 'required_if:is_scheduled,on|date|after_or_equal:start_date',
            'start_time' => 'required_if:is_scheduled,on',
            'end_time' => 'required_if:is_scheduled,on',
        ];
    }
}
