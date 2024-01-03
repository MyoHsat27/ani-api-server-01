<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class StorePrivateAnimeWatchlistRequest extends FormRequest
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
        $watchlistId = request()->route('watchlist')->id;

        return [
            'anime_id' => [
                'required',
                Rule::exists('private_animes', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
                Rule::unique('private_anime_watchlists', 'private_anime_id')
                    ->where(function ($query) use ($watchlistId) {
                        $query->where('watchlist_id', $watchlistId);
                    }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'anime_id.exists' => 'The selected anime does not exist',
            'anime_id.unique' => 'The selected anime is already in your watchlist',
        ];
    }
}
