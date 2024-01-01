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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|min:4|max:20',
            'email'    => 'required|unique:users,email|email|regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'status'  => 'error',
            'message' => "Validation error",
            'errors'  => $validator->errors(),
        ], 401);
        throw new HttpResponseException($response);
    }
}
