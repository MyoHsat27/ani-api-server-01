<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class StorePrivateMangaReadlistRequest extends FormRequest
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
        $readlistId = request()->route('readlist')->id;

        return [
            'manga_id' => [
                'required',
                Rule::exists('private_mangas', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
                Rule::unique('private_manga_readlists', 'private_manga_id')
                    ->where(function ($query) use ($readlistId) {
                        $query->where('readlist_id', $readlistId);
                    }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'manga_id.exists' => 'The selected manga does not exist',
            'manga_id.unique' => 'The selected manga is already in your readlist',
        ];
    }
}
