<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{



    # make new registration here
    protected function create(array $data)
    {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => validatePhone($data['phone']),
                'password' => Hash::make($data['password']),
            ]);
            // set guest_user_id to user_id from carts
            return $user;
        }
        return null;
    }

    # register new customer here
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];

        // Add email validation if email is provided
        if (isset($request->email) && !empty($request->email)) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        // Add phone validation if phone is provided
        if (isset($request->phone) && !empty($request->phone)) {
            $rules['phone'] = 'required|unique:users,phone';
        }

        // Ensure at least email or phone is provided
        $rules['email'] = 'required_without:phone|nullable|email|unique:users,email';
        $rules['phone'] = 'required_without:email|nullable|unique:users,phone';

        $validator = Validator::make($request->all(), $rules, [
            'email.unique' => 'This email address is already registered. Please use a different email or try logging in.',
            'phone.unique' => 'This phone number is already registered. Please use a different phone number or try logging in.',
            'email.required_without' => 'Either email or phone number is required.',
            'phone.required_without' => 'Either email or phone number is required.',
        ]);

        if ($validator->fails()) {
            return $this->registrationFailed($validator->errors()->all());
        }

        $user = $this->create($request->all());
        # verification
        if ($user) {
            if (getSetting('registration_verification_with') == "disable") {
                $user->email_or_otp_verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->save();
                return $this->loginSuccess($user);
            } else {
                if (getSetting('registration_verification_with') == 'email') {
                    try {
                        $user->sendVerificationNotification();
                        return response()->json([
                            'result' => true,
                            'message' => localize('Registration successful. Please verify your email.'),
                            'access_token' => '',
                            'token_type' => ''
                        ]);
                    } catch (\Throwable $th) {
                        $user->delete();
                        return $this->registrationFailed(localize('Registration failed. Please try again later.'));
                    }
                }
                // else being handled in verification controller
            }
        } else {
            return $this->registrationFailed("Registration failed");
        }
    }


    public function login(Request $request)
    {
        $user = User::where('user_type', $request->type)
            ->where('email', $request->email)
            ->orWhere('phone', $request->email)
            ->first();
        if ($user != null) {
            if (!$user->is_banned) {
                if (Hash::check($request->password, $user->password)) {

                    if ($user->email_verified_at == null) {
                        return $this->loginFailed(localize('Please verify your account'));
                    }
                    return $this->loginSuccess($user);
                } else {
                    return $this->loginFailed(localize('Unauthorized'));
                }
            } else {
                return $this->loginFailed(localize('User is banned'));
            }
        } else {
            return $this->loginFailed(localize('User not found'));
        }
    }

    protected function loginSuccess($user)
    {
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'result' => true,
            'message' => localize('Successfully logged in'),
            'access_token' => $token,
            'token_type' => 'Bearer',
            "user"=>[
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'balance' => $user->user_balance,
                'avatar' => uploadedAsset($user->avatar)
            ]
        ]);
    }
    protected function loginFailed($message)
    {
        return response()->json([
            'result' => false,
            'message' => $message,
            'access_token' => '',
            'token_type' => '',
            "user"=>   [
                'name' => "",
                'email' => "",
                'phone' => "",
                'balance' => "",
                'avatar' => ""
                ]
        ]);
    }

    protected function registrationFailed($message)
    {
        return response()->json([
            'result' => false,
            'message' => $message,
            'access_token' => '',
            'token_type' => ''
        ]);
    }

    public function checkToken(Request $request)
    {

        $false_response = [
            'result' => false,
             "user"=>   [
                'name' => "",
                'email' => "",
                'phone' => "",
                'balance' => "",
                'avatar' => ""
                ]
        ];

        $token=PersonalAccessToken::findToken($request->bearerToken());
        if (!$token) {
            return response()->json($false_response);
        }

        $user = $token->tokenable;

        if ($user->is_banned) {
        return response()->json([
            'result' => false,
            "is_banned"=>true,
            'message' => localize("You have been banned")
        ]);
        }

        if ($user == null) {
            return response()->json($false_response);

        }

        return response()->json([
            'result' => true,
            "user"=>[
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'balance' => $user->user_balance,
                'avatar' => uploadedAsset($user->avatar)
            ]
        ]);

    }
    public function logout(Request $request)
    {

        $false_response = [
            'result' => false,
             "user"=>   [
                'name' => "",
                'email' => "",
                'phone' => "",
                'balance' => "",
                'avatar' => ""
                ]
        ];

        $user = auth()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        if ($user->is_banned) {
        return response()->json([
            'result' => false,
            "is_banned"=>true,
            'message' => localize("You have been banned")
        ]);
        }

        if ($user == null) {
            return response()->json($false_response);

        }

        return response()->json([
            'result' => true,
            "user"=>[
                'name' =>"",
                'email' => "",
                'phone' => "",
                'balance' => "",
                'avatar' => ""
            ]
        ]);

    }


}
