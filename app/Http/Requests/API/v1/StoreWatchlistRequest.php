<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreWatchlistRequest extends FormRequest
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
         'name' => [
            'required',
            'string',
            'max:50',
            'min:3',
            Rule::unique('watchlists')->where(function ($query) {
               return $query->where('user_id', Auth::id());
            }),
         ],
         'description' => 'max:500|string',
      ];
   }
}
