<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $response = $this->apiHelper->makeResponse('failed', 'Please login first!');

        return $response;
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = $this->apiHelper->makeResponse('failed', $validator->errors()->messages());

            return response()->json($response);
        }

        try {
            $param = $request->all();
            $param['password'] = bcrypt($request->password);

            $user = User::create($param);
            $token = $user->createToken('auth_token')->plainTextToken;

            $data = [
                'user' => $user,
                'token' => $token
            ];

            $response = $this->apiHelper->makeResponse('success', 'Register success!', 1, $data);

            return response()->json($response);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = $this->apiHelper->makeResponse('failed', $validator->errors()->messages());

            return response()->json($response);
        }

        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                $response = $this->apiHelper->makeResponse('failed', __('auth.failed'));

                return response()->json($response);
            }

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            $data = [
                'user' => $user,
                'token' => $token
            ];

            $response = $this->apiHelper->makeResponse('success', 'Login success!', 1, $data);

            return response()->json($response);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            $response = $this->apiHelper->makeResponse('success', 'Logout success!');

            return response()->json($response);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }
}
