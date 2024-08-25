<?php

namespace App\Http\Requests\User;

use App\Rules\User\MaxParticiapantCountPerRoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuickMeetingRequest extends BaseUserRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'required|string',
            'room' => ['required' , Rule::in(getAuthUser('web')->rooms->pluck('id'))  , new MaxParticiapantCountPerRoom($this->room)],
        ];
    }
}
