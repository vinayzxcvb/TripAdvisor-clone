<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle a registration request.
     * After registration, the user must log in separately.
     */
    public function register(Request $request)
    {
        // 1. Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Return a success response, prompting the user to log in
        return response()->json([
            'message' => 'Registration successful. Please log in to continue.',
            'user' => $user
        ], 201); // 201 Created
    }

    /**
     * Handle a login request and issue an API token.
     */
    public function login(Request $request)
    {
        // 1. Validate the incoming data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401); // 401 Unauthorized
        }

        // 3. Find the user and create a token
        $user = User::where('email', $request->email)->firstOrFail();
        
        // Revoke all old tokens and create a new one
        $user->tokens()->delete();
        $token = $user->createToken('api-token')->plainTextToken;

        // 4. Return the user and the token
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function logout()
    {

        auth('api')->logout();
        return response()->json(['message' => 'Logged out']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        $newToken = JWTAuth::parseToken()->refresh();
        return $this->respondWithToken($newToken);
    }
}
