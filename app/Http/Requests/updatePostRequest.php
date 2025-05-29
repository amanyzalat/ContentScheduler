<?php

namespace App\Http\Requests;

use App\Rules\InLangRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class updatePostRequest extends FormRequest
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
           'title' => 'sometimes|string',
            'content' => 'sometimes|string',
            'image_url' => 'nullable|url',
            'scheduled_time' => 'nullable|date',
            'status' => 'in:draft,scheduled,published',
            'platforms' => 'nullable|array',
            'platforms.*.id' => 'required_with:platforms|exists:platforms,id',
            'platforms.*.platform_status' => 'required_with:platforms|string'
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
