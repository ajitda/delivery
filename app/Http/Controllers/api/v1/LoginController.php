<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function login(Request $request) {

        $input = $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ], [
            'email.exists' => 'The user credentials were incorrect.',
        ]);

        request()->request->add([
            'grant_type' => 'password',
            'client_id' => config('delivery.password_client_id'),
            'client_secret' => config('delivery.password_client_secret'),
            'username' => $input['email'],
            'password' => $input['password'],
        ]);

        $response = Route::dispatch(Request::create('/oauth/token', 'POST'));

        $data = json_decode($response->getContent(), true);

        if (!$response->isOk()) {
            return $this->sendError($data);
        }
        $user = User::where('email', $input['email'])->first();
        $data['user_id'] = $user->id;
        $data['company_id'] = $user->companies->first()->id;
        return $this->sendResponse($data);
    }

    public function logout(Request $request)
    {
        $accessToken = $request->user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true,
            ]);

        $accessToken->revoke();

        return response()->json([], 201);
    }
}
