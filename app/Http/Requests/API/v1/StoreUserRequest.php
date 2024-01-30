<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:4|max:20|unique:users,username',
            'email'    => 'required|unique:users,email|email|regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/',
            'role_id'  => 'required|exists:roles,id',
            'password' => 'required|min:8|confirmed',
        ];
    }

}
