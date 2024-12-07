<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user and generate an authentication token.
     *
     * @param Request $request The HTTP request containing user registration data.
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the request data.
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed' // Ensures 'password_confirmation' field matches.
        ]);

        // Create a new user record in the database.
        $user = User::create($fields);

        // Generate a personal access token for the user.
        $token = $user->createToken($request->name);

        // Return success response with user and token details.
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => [
                'token' => $token->plainTextToken,
                'user' => $user
            ]
        ]);
    }

    /**
     * Log in a user and return an authentication token.
     *
     * @param Request $request The HTTP request containing login credentials.
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the login request data.
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        // Find the user by email.
        $user = User::where('email', $request->email)->first();

        // Verify the provided password.
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Return error response if credentials are incorrect.
            return response()->json([
                'success' => false,
                'errors' => [
                    'password' => ['The provided credentials are incorrect.']
                ]
            ], 401);
        }

        // Generate a personal access token for the authenticated user.
        $token = $user->createToken($user->name);

        // Return success response with user and token details.
        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'data' => [
                'token' => $token->plainTextToken,
                'user' => $user
            ]
        ]);
    }

    /**
     * Log out the authenticated user by revoking their token.
     *
     * @param Request $request The HTTP request containing the user's current token.
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the current user's token.
        $request->user()->token()->revoke();

        // Return success response.
        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully'
        ]);
    }
}
