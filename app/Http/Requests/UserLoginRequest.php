<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'phone' => 'required|min:9|numeric',
            'password' => 'required|min:8',
            'deviceToken'=>'string'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        // Transform the errors to return only the error messages in an array
        $errorMessages = [];
        foreach ($errors as $field => $messages) {
            $errorMessages = array_merge($errorMessages, $messages);
        }
        $arrayMes=['message'=>$errorMessages[0],'errors'=>$errorMessages];
        // Throw an HTTP exception with the transformed error structure
        throw new HttpResponseException(response()->json([
            'message'=>'Fail!',
            'data'=>[],
            'pagination' =>  null,
            'errors' => $arrayMes,
        ], 422));
    }
  
}