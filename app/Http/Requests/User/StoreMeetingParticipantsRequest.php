<?php

namespace App\Http\Requests\User;

use App\Enums\RoleEnum;
use App\Rules\User\MaxParticipantCountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeetingParticipantsRequest extends BaseUserRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'participants' => ['required', 'array', new MaxParticipantCountRule($this->route('id'))],
            'participants.*.name' => [
                'required',
                'string',
            ],
            'participants.*.email' => [
                'nullable',
                'string',
                'email',
            ],
            'participants.*.role' => ['required', Rule::in([RoleEnum::MODERATOR->value, RoleEnum::VIEWER->value])],
            'participants.*.password' => ['nullable', 'min:8'],
        ];
    }
}
