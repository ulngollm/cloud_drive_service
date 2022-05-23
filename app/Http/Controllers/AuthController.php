<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::create();
        $token = $user->createToken('storage', ['storage:access'])->plainTextToken;
        return ['token' => $token];
    }
}
