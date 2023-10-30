<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiResponse;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);


            $data['token'] = $user->createToken("API TOKEN")->plainTextToken;
            $data['message'] = 'User Created Successfully';
            $data['email'] = $user->email;
            $data['name'] = $user->name;
            return ApiResponse::sendResponse(200, $data, 'Successfully created');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {

                return ApiResponse::sendResponse(401, null, 'Email & Password does not match with our record.');
            }

            $user = User::where('email', $request->email)->first();

            $data['token'] = $user->createToken("API TOKEN")->plainTextToken;
            $data['message'] = 'User Created Successfully';
            $data['email'] = $user->email;
            $data['name'] = $user->name;
            return ApiResponse::sendResponse(200, $data, 'User Logged In Successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logoutuser(Request $request)
    {

        $user = $request->user(); //or Auth::user()

        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'status' => false,
            'msg' => 'doneeeeeee'
        ]);
    }
    public function userprofile(Request $request)
    {
        $user =  $request->user();

        return ApiResponse::sendResponse(200, $user, 'User Logged In Successfully');
    }
}
