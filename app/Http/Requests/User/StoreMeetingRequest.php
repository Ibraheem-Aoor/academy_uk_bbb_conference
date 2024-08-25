<?php

namespace App\Http\Requests\User;

use App\Rules\User\MaxParticiapantCountPerRoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeetingRequest extends BaseUserRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = getAuthUser('web');
        return [
            'name' => 'required|string|min:2|max:256',
            'welcome_message' => 'required|string',
            'password' => 'nullable|min:8',
            'room_id' => ['required' , Rule::in($user->rooms->pluck('id'))],
            'max_participants' => ['required'  , 'numeric' ,'gt:0', new MaxParticiapantCountPerRoom($this->room_id)],
            'is_scheduled' => 'nullable|in:on,off',
            'start_date' => 'required_if:is_scheduled,on|date|after_or_equal:today',
            'end_date' => 'required_if:is_scheduled,on|date|after_or_equal:start_date',
            'start_time' => 'required_if:is_scheduled,on',
            'end_time' => 'required_if:is_scheduled,on',
        ];
    }
}
