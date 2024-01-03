<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class StorePrivateMangaRequest extends FormRequest
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
            'name'              => [
                'required',
                'string',
                'max:50',
                'min:3',
                Rule::unique('private_mangas')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
            'description'       => 'required|max:1000|string',
            'alt_name'          => 'max:50|nullable',
            'chapter'           => 'required|numeric',
            'resource_url'      => 'nullable|url',
            'image_url'         => 'nullable|url',
            'release_status_id' => 'required|exists:release_statuses,id',
            'manga_type_id'     => 'required|exists:manga_types,id',
            'genres'            => 'required|exists:private_genres,id|array',
        ];
    }

    public function messages(): array
    {
        return [
            "genres.exists" => "Selected genres are not existed",
        ];
    }
}
