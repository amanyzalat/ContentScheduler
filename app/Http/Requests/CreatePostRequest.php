<?php

namespace App\Http\Requests;

use App\Rules\InLangRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|string',
              'content' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                $platformsInput = $this->input('platforms', []);
                $platformIds = collect($platformsInput)->pluck('id')->toArray();
                $platforms = Platform::whereIn('id', $platformIds)->get();
                foreach ($platforms as $platform) {
                    switch ($platform->type) {
                        case 'twitter':
                            if (strlen($value) > 280) {
                                $fail('Content exceeds Twitter character limit (280).');
                            }
                            break;

                        case 'linkedin':
                            if (strlen($value) > 1300) {
                                $fail('Content exceeds LinkedIn character limit (1300).');
                            }
                            break;

                        case 'instagram':
                            if (strlen($value) > 2200) {
                                $fail('Content exceeds Instagram character limit (2200).');
                            }

                            // Check for links
                            if (preg_match('/https?:\/\/\S+/', $value)) {
                                $fail('Instagram captions cannot contain clickable links.');
                            }
                            break;
                        case 'facebook':
                            if (strlen($value) > 63206) {
                                $fail('Content exceeds Facebook character limit (63,206).');
                            }
                            break;
                    }
                }
            }
        ],
           
            'image_url' => 'nullable|url',
            'scheduled_time' => 'nullable|date|after:now',
            'status' => 'required|in:draft,scheduled,published',
            'platforms' => 'required|array',
            'platforms.*.id' => 'required|exists:platforms,id',
            'platforms.*.platform_status' => 'required|string'
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
        $arrayMes = ['message' => $errorMessages[0], 'errors' => $errorMessages];
        // Throw an HTTP exception with the transformed error structure
        throw new HttpResponseException(response()->json([
            'message' => 'Fail!',
            'data' => [],
            'pagination' =>  null,
            'errors' => $arrayMes,
        ], 422));
    }
     public function withValidator($validator)
    {
        $validator->after(function (Validator $validator) {
            $user = Auth::user();

            $scheduledCountToday = Post::where('user_id', $user->id)
                ->whereDate('scheduled_time', now()->toDateString())
                ->where('status', 'scheduled') 
                ->count();

            if ($scheduledCountToday >= 10) {
                $validator->errors()->add(
                    'scheduled_time',
                    'You have reached the daily limit of 10 scheduled posts.'
                );
            }
        });
    }
}
