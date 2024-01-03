<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class StorePrivateAnimeMovieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => [
                'required',
                'string',
                'max:50',
                'min:3',
            ],
            'description'  => 'required|max:500|string',
            'alt_name'     => 'required|max:50|nullable',
            'release_status_id' =>'required|exists:release_statuses,id',
            'private_anime_id'  =>'required|exists:private_animes,id'
        ];
    }
}
