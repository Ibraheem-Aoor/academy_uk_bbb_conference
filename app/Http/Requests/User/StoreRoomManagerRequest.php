<?php

namespace App\Http\Requests\User;

use App\Rules\User\MaxParticiapantCountPerRoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomManagerRequest extends BaseUserRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $email_unique_rule = $this->id ? 'required|email|unique:users,email,' . decrypt($this->id ): 'required|email|unique:users,email';
        return [
            'name' => 'required|string',
            'email' => $email_unique_rule,
            'password' => 'required|min:8',
            'rooms' => ['required', 'array'],
            'rooms.*' => ['required', Rule::in(getAuthUser('web')->rooms->pluck('id'))],
        ];
    }
}
