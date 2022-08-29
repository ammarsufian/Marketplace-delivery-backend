<?php

namespace App\Domains\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCreditCardRequest extends FormRequest
{
   //Carbon::parse('12.1.2017')->format('Y-m-d')
   //TODO::write handling messages exception in ar,en languages

   public function authorize() : bool
   {
     return true;
   }

   public function rules() : array
   {
      return [
          'card_number' =>['required','unique:credit_cards,card_number'],
          'cvv' => ['required'],
          'name' =>['required'],
          'expiration_date' => ['required','date_format:m/y'],
      ];
   }
}

