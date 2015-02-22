<?php

use GuzzleHttp\Subscriber\Oauth\Oauth1;

class AuthController extends \BaseController {



    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        $user = User::where('email', '=', $email)->first();

        if (!$user)
        {
            return Response::json(array('message' => 'Wrong email and/or password'), 401);
        }

        if (Hash::check($password, $user->password))
        {
            unset($user->password);
            return Response::json(array('token' => $this->createToken($user)));
        }
        else
        {
            return Response::json(array('message' => 'Wrong email and/or password'), 401);
        }
    }

    public function signup()
    {
        $input['displayName'] = Input::get('displayName');
        $input['email'] = Input::get('email');
        $input['password'] = Input::get('password');

        $rules = array('displayName' => 'required',
                       'email' => 'required|email|unique:users,email',
                       'password' => 'required');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Response::json(array('message' => $validator->messages()), 400);
        }
        else
        {
            $user = new User;
            $user->displayName = Input::get('displayName');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Response::json(array('token' => $this->createToken($user)));

        }
    }
    
     public function google()
    {
        $accessTokenUrl = 'https://accounts.google.com/o/oauth2/token';
        $peopleApiUrl = 'https://www.googleapis.com/plus/v1/people/me/openIdConnect';
        $params = array(
            'code' => Input::get('code'),
            'client_id' => Input::get('clientId'),
            'redirect_uri' => Input::get('redirectUri'),
            'grant_type' => 'authorization_code',
            'client_secret' => Config::get('secrets.GOOGLE_SECRET')
        );
        $client = new GuzzleHttp\Client();
        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->post($accessTokenUrl, ['body' => $params]);
        $accessToken = $accessTokenResponse->json()['access_token'];
        $headers = array('Authorization' => 'Bearer ' . $accessToken);
        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->get($peopleApiUrl, ['headers' => $headers]);
        $profile = $profileResponse->json();
        // Step 3a. If user is already signed in then link accounts.
        if (Request::header('Authorization'))
        {
            $user = User::where('google', '=', $profile['sub']);
            if ($user->first())
            {
                return Response::json(array('message' => 'There is already a Google account that belongs to you'), 409);
            }
            $token = explode(' ', Request::header('Authorization'))[1];
            $payloadObject = JWT::decode($token, Config::get('secrets.TOKEN_SECRET'));
            $payload = json_decode(json_encode($payloadObject), true);
            $user = User::find($payload['sub']);
            $user->google = $profile['sub'];
            $user->username = $user->username || $profile['name'];
            $user->save();
            return Response::json(array('token' => $this->createToken($user)));
        }
        // Step 3b. Create a new user account or return an existing one.
        else
        {
            $user = User::where('google', '=', $profile['sub']);
            if ($user->first())
            {
                return Response::json(array('token' => $this->createToken($user->first())));
            }
            $user = new User;
            $user->google = $profile['sub'];
            $user->username = $profile['name'];
            $user->save();
            return Response::json(array('token' => $this->createToken($user)));
        }
    }

}