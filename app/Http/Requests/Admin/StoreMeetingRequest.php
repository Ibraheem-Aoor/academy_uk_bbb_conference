<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends BaseAdminRequest
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
            'duration' => 'required|numeric',
            'max_participants' => 'required|numeric',
        ];
    }
}
