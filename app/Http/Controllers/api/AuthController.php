<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login",
     *     tags={"Auth"},
     *     operationId="login",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="example@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Password")
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Authorization error",
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Return access token",
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'You cannot sign with those credentials'], 422);
        }

        $token = Auth::user()->createToken('Access Token')->accessToken;

//        $token = '228';

        return response()->json(['Access Token' => $token], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout",
     *     tags={"Auth"},
     *     operationId="logout",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="logout is successful"
     *     ),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'logout is successful']);
    }

    /**
     * @OA\Post(
     *     path="/api/resetPassword",
     *     summary="Reset psssword",
     *     tags={"Auth"},
     *     operationId="resetPassword",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="example@example.com"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Incorrect email address",
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Password send to email",
     *     ),
     * )
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        if (User::where('email', '=', $request->email)->exists()) {
            Password::sendResetLink($request->only('email'));

            return response()->json(['message' => 'Password send to email'], 200);
        }

        return response()->json(['message' => 'User with this email does not exist'], 422);
    }
}
