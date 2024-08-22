<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseAdminRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $email_unique_rule = !isset($this->id)
        ? 'unique:users,email'
        : 'unique:users,email,' . ($this->id);
        return [
            'name' => 'required|string|unique:meetings,name',
            'email' => ['required' , 'string' , $email_unique_rule],
            'password' => 'required|min:8',
            'max_meetings' => 'required|numeric|integer',
            'max_participants' => 'required|numeric|integer',
            'max_storage_allowed' => 'required|numeric|integer',
        ];
    }
}
