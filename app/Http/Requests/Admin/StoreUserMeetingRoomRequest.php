<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserMeetingRoomRequest extends BaseAdminRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rooms' => 'required|array',
            'rooms.*.name' => 'nullable|string',
            'rooms.*.max_meetings' => 'required|numeric|integer',
            'rooms.*.max_participants' => 'required|numeric|integer',
        ];
    }

    public function messages()
    {
        return [
            'rooms.required' => 'The rooms field is required',
            'rooms.array' => 'The rooms field must be an array',
            'rooms.*.name.string' => 'The name field must be a string',
            'rooms.*.max_meetings.required' => 'The max meetings field is required',
            'rooms.*.max_meetings.numeric' => 'The max meetings field must be a numeric value',
            'rooms.*.max_meetings.integer' => 'The max meetings field must be an integer value',
            'rooms.*.max_participants.required' => 'The max participants field is required',
            'rooms.*.max_participants.numeric' => 'The max participants field must be a numeric value',
            'rooms.*.max_participants.integer' => 'The max participants field must be an integer value',
        ];
    }

}
