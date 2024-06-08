<?php

namespace Modules\UserAndLead\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAndLeadRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'owner' => 'required|integer|exists:users,id'
        ];
    }
}
