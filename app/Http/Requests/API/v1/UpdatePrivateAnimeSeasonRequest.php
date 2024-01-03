<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePrivateAnimeSeasonRequest extends FormRequest
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
                'string',
                'max:50',
                'min:3'
            ],
            'description' => 'max:500|string',
            'episode'     => 'numeric',
            'release_status_id' =>'exists:release_statuses,id',
            'private_anime_id'  =>'exists:private_animes,id'
        ];
    }
}
