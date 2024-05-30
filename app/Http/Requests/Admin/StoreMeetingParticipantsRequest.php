<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeetingParticipantsRequest extends BaseAdminRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'participants' => ['required', 'array'],
            'participants.*.name' => [
                'required',
                'string',
                Rule::unique('participants')->where(function ($query){
                    return $query->where('meeting_id', ($this->meeting));
                }),
            ],
            'participants.*.role' => ['required' , Rule::in([RoleEnum::MODERATOR->value , RoleEnum::VIEWER->value])],
        ];
    }
}
