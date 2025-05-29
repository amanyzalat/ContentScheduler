<?php

namespace App\Http\Repositories\Dashboard\AdminAuth;


use App\Models\User;

use App\Mail\ResetPasswordMail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Repositories\Base\BaseRepository;

class AdminAuthRepository extends BaseRepository implements AdminAuthInterface
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login($request)
    {
        $model = $this->model->where('email', $request->email)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.email')]]];
        }
        if (!Hash::check($request->password, $model->password)) {
            return ['status' => false, 'errors' => ['error' =>[trans('auth.password')]]];
        }
        return ['status' => true, 'data' => $model];
    }

    public function resetPassword($request)
    {
        $code = rand(111111, 999999);
        $model = $this->model->where('email', $request->email)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.email')]]];
        }
        $model->update(['code' => $code]);
        $model->refresh();
        Mail::to($model->email)->send(new ResetPasswordMail($code));
        return ["status" => true];
    }

    public function pinCodeConfirmation($request)
    {
        $model = $this->model->where('email', $request->email)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.email')]]];
        }
        $model = $this->model->where('code', $request->code)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.invalid', ['attribute' => 'code'])]]];
        }
        $updatedAt = $model->updated_at;
        $now = now();
        $timeDifferenceInMinutes = $now->diffInMinutes($updatedAt);
        if ($timeDifferenceInMinutes >= 5) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.invalid', ['attribute' => 'code'])]]];
        }
        $model->update([
            'code' => null,
            'token' => \Illuminate\Support\Str::random(60),
        ]);
        return ['status' => true, 'data' => $model];
    }

    public function confirmPassword($request)
    {
        $model = $this->model->where('token', $request->token)->where('token', '!=', null)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('auth.invalid', ['attribute' => 'token'])]]];
        }
      
      
        $model->update(['token' => null, 'password' => $request->password]);
        return ['status' => true];
    }

   
}