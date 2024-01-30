<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePrivateGenreRequest extends FormRequest
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
       $currentGenreId = $this->route('private_genre')->id;
        return [
           'name' => [
              'required',
              'string',
              'max:50',
              'min:3',
              Rule::unique('private_genres')->where(function ($query) {
                 return $query->where('user_id', Auth::id());
              })->ignore($currentGenreId)
           ],
            'description' => 'string|max:1000',
        ];
    }
}
