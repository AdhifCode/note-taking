<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        // if ($token= Auth::attempt($credentials)) {
        //     $user = Auth::user();
        //     return response()->json(['token' => $token], 200);
        // } else {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        // dd(Auth::attempt($credentials));
        if (!$token = Auth::attempt($credentials)) {
            // dd($token);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
            $user=auth()->user();
            $userNotes = $user->UserNotes;
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'user' => $user,
            'message' => 'Berhasil login',
            'success' => true,
            'status' => 201,
        ], 201);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal.', 'errors' => $validator->errors()], 400);
        }
        try {
            $requests = $request->all();
            $requests['password'] = Hash::make($requests['password']);
            $note = User::create($requests);

            return response()->json([
                'data' => $note,
                'message' => 'Berhasil Register data',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan saat menambah data: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function refresh()
    {
        return $this->jsonResponse(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'user'         => auth()->user(),
            'expires_in'   => auth()->factory()->getTTL() * 60 * 24
        ]);
    }
}
