<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdatePrivateAnimeRequest extends FormRequest
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
        $currentAnimeId = $this->route('private_anime')->id;

        return [
            'name'              => [
                'sometimes',
                'string',
                'max:50',
                'min:3',
                Rule::unique('private_animes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($currentAnimeId),
            ],
            'description'       => 'sometimes|max:1000|string',
            'alt_name'          => 'sometimes|max:50|nullable',
            'resource_url'      => 'sometimes|nullable|url',
            'image_url'         => 'sometimes|nullable|url',
            'release_status_id' => 'sometimes|exists:release_statuses,id',
            'genres'            => [
                'sometimes',
                'array',
                Rule::exists('private_genres', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
        ];
    }
}
