<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Provider;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //Register
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request['email'])->firstOrFail();
        $user->tokens()->delete();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['massage' => 'Bad creds'], 401);
        } else {
            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }
    }

    //Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ['massage' => 'logout'];
    }

    //Redirect_Google    
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Callback_Google   
    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->getEmail())->first();
            $finduser = Provider::where('provider_id', $user->id)->first();

            if ($finduser) {

                $user = User::where('email', $user->getEmail())->first();
                $user->tokens()->delete();
                $token = $user->createToken('token-google')->plainTextToken;

                $response = [
                    'user' => $user,
                    'token' => $token
                ];

                return response($response, 201);
            } else {
                $userCreated = User::firstOrCreate(
                    [
                        'email' => $user->getEmail(),
                        'password' => encrypt('my-google')
                    ],
                    [
                        'email_verified_at' => now(),
                        'name' => $user->getName(),
                        'status' => true,
                    ]
                );
                $userCreated->providers()->updateOrCreate(
                    [
                        'provider' => 'google',
                        'provider_id' => $user->getId(),
                    ],
                    [
                        'avatar' => $user->getAvatar()
                    ]
                );

                $token = $userCreated->createToken('token-google')->plainTextToken;

                $response = [
                    'user' => $userCreated,
                    'token' => $token
                ];


                return response($response, 201);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Invalid credentials provided.',
                'Exception' => $e
            ], 422);
        }
    }
}
