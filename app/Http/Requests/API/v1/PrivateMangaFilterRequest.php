<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrivateMangaFilterRequest extends FormRequest
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
         'chapter-from' => 'numeric',
         'chapter-to' => 'numeric',
         'manga-type' => Rule::in(['manga', 'manhua', 'manhwa']),
         'status' => Rule::in(['on-going', 'coming-soon', 'finished', 'dropped']),
      ];
   }

   public function messages()
   {
      return [
         'manga-type' => "The manga-type parameter accepts only 'manga', 'manhua' and 'manhwa'",
         'status' => "The status parameter accepts only 'on-going', 'coming-soon', 'finished' and 'dropped'",
      ];
   }
}
