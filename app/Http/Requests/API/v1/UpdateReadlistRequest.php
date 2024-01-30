<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateReadlistRequest extends FormRequest
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
        $currentReadlist = $this->route('readlist')->id;

        return [
            'name'        => [
                'string',
                'max:50',
                'min:3',
                Rule::unique('readlists')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($currentReadlist),
            ],
            'description' => 'sometimes|max:1000|string',
        ];
    }
}
