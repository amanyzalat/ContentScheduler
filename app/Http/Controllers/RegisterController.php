<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use App\Http\Requests\RegisterRequest;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\ConfirmTokenRequest;
use App\Http\Requests\AdminResetPasswordRequest;
use App\Http\Requests\AdminConfirmPasswordRequest;
use App\Http\Repositories\Dashboard\AdminAuth\AdminAuthInterface;

class RegisterController extends Controller
{
    public function __construct(private AdminAuthInterface $modelInterface, public ResponseService $ResponseService)
    {
        $this->modelInterface = $modelInterface;
    }

    public function loginAdmin(RegisterRequest $request)
    {
        $auth = $this->modelInterface->login($request);
        if (!$auth) {
            return $this->ResponseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }
        if (!$auth['status']) {
            return $this->ResponseService->json('Fail!', [], 400, $auth['errors']);
        }
        $token = $auth['data']->createToken('nawaya')->plainTextToken;
        $permissions=$auth['data']->AdminPermissions;
        $admin = new AdminResource($auth['data'], $token);

        return $this->ResponseService->Json("success", ['token' => $token, 'admin' => $admin,'permissions'=>$permissions], 200);
    }
    public function resetPassword(AdminResetPasswordRequest $request)
    {
        $auth = $this->modelInterface->resetPassword($request);
        if (!$auth) {
            return $this->ResponseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }
        if (!$auth['status']) {
            return $this->ResponseService->json('Fail!', [], 400, $auth['errors']);
        }
        return $this->ResponseService->Json("success", [], 200);
    }
    public function confirmPinCode(ConfirmTokenRequest $request)
    {
        $auth = $this->modelInterface->pinCodeConfirmation($request);
        if (!$auth) {
            return $this->ResponseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }
        if (!$auth['status']) {
            return $this->ResponseService->json('Fail!', [], 400, $auth['errors']);
        }
        return $this->ResponseService->Json("success", $auth['data']->token, 200);
    }

    public function confirmPassword(AdminConfirmPasswordRequest $request)
    {
        $auth = $this->modelInterface->confirmPassword($request);
        if (!$auth) {
            return $this->ResponseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }
        if (!$auth['status']) {
            return $this->ResponseService->json('Fail!', [], 400, $auth['errors']);
        }
        return $this->ResponseService->Json("success", [], 200);
    }

  

}