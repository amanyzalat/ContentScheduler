<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserResetPasswordRequest extends FormRequest
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
            'code' => 'required|min:6|max:6',
            'phone' => 'required|min:11|numeric',
           
        ];
    }

    public function messages()
    {
        return [
            'code.required' => trans('validation.custom.code.required'),
            'code.min' => trans('validation.custom.code.min'),
            'code.max' => trans('validation.custom.code.max'),
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