<?php

namespace App\Http\Requests\API\v1;

use App\Models\PrivateAnime;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePrivateAnimeSeasonRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
      return true;
   }

   public function prepareForValidation()
   {
      $season = $this->route('season');
      $this->merge(['season' => $season]);
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {
      $privateAnime = $this->route('private_anime');
      return [
         'name' => [
            'required',
            'string',
            'max:50',
            'min:3',
            Rule::unique('private_anime_seasons')->where(function ($query) use ($privateAnime) {
               return $query->where('private_anime_id', $privateAnime->id);
            }),
         ],
         'description' => 'required|max:500|string',
         'episode' => 'required|numeric',
         'release_status_id' => 'required|exists:release_statuses,id',
      ];
   }
}
