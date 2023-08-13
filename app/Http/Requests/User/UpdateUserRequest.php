<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'patronymic' => 'required|max:50',
            'password' => 'required',
            'email' => 'required',
            'group_id' => 'required',
            'birthdate' => 'required|date',
            'address'    => 'required',
            'address.city'  => 'required',
            'address.street'  => 'required',
            'address.building'  => 'required|numeric',
        ];
    }
}
