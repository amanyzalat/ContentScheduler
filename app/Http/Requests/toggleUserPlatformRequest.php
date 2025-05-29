<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class toggleUserPlatformRequest extends FormRequest
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
             'platform_id' => 'required|exists:platforms,id',
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
   /* public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->input('room_reservations', []) as $index => $reservation) {
            $children = (int)$reservation['children'];
            $ages = explode(',',$reservation['ages']);
            
            // If 'children' is provided, perform the validation for 'ages'
            if ($children) {
                // Check if 'ages' is provided and the count matches the number of children
                if (!$ages || count($ages) !== $children) {
                    $validator->errors()->add("room_reservations.{$index}.ages", trans('messages.ages'));
                }

                // Check that each 'age' is a number
                foreach ($ages as $index => $age) {
                    if (!is_numeric($age)) {
                        $validator->errors()->add("room_reservations.{$index}.ages", trans('messages.agenum',['num'=> ($index + 1)]));
                    }
                }
            }else {
                // If 'children' = 0, 'ages' must not have any values
                if (!$ages>0 &&count($ages) > 0) {
                    $validator->errors()->add("room_reservations.{$index}.ages", trans('messages.noages'));
                }
            }
        }
        });
    }*/
    
}
