<?php

namespace App\Http\Requests\User;

use App\DTOs\AccountTreeDto;
use App\DTos\WebshopAccountDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountTreeRequest extends BaseUserRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'parent_account' => 'nullable',
            'number' => [
                'required',
                'numeric',
                Rule::unique('account_trees', 'number')->when($this->id, function ($rule) {
                    $rule->ignore(decrypt($this->id), 'id');
                })
            ],
            'name' => 'required',
        ];
    }


    public function toDto(): AccountTreeDto
    {
        return new AccountTreeDto(
            type: ($this->validated('type')),
            parent_id: $this->validated('parent_account'),
            name: $this->validated('name'),
            number: $this->validated('number'),
            is_active: isset($this->status) && $this->status == 'on',
        );
    }
}
