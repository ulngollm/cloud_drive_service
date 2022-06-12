<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        $user = User::create();
        $token = $user->createToken('storage', ['storage:access'])->plainTextToken;
        return ['token' => $token];
    }

    public function deleteUser(Request $request)
    {
        $user = $request->user();
        return ['result' => $user->delete()];
    }
}
