<?php

namespace App\Http\Repositories\Dashboard\AdminAuth;

interface AdminAuthInterface
{
    public function login($request);
    public function resetPassword($request);
    public function pinCodeConfirmation($request);
    public function confirmPassword($request);
 
}