<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivateAnimeWatchStatusRequest extends FormRequest
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
         'season' => 'required|min:0|max:100',
         'episode' => 'required|min:0|max:10000|integer',
         'watch_status_id' => 'required|exists:watch_statuses,id',
         'favourite_level_id' => 'required|exists:favourite_levels,id',
      ];
   }
}
