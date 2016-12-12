<?php

namespace App\Http\Controllers;

use App\GDrive\GoogleD;
use Illuminate\Http\Request;

class OauthController extends Controller
{

    public function login(Request $request)
    {
        $client = GoogleD::getInstance()->getClient();
        if ($request->has('code')) {
            $client->authenticate($request->code);
            $accessToken = $client->getAccessToken();

            $googlePlusService = new \Google_Service_Plus($client);
            $me                = $googlePlusService->people->get('me');
            $id                = $me['id'];
            $email             = $me['emails'][0]['value'];
            $firstName         = $me['name']['givenName'];
            $lastName          = $me['name']['familyName'];

            session()->put([
                'user' => [
                    'email'     => $email,
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                    'token'     => $accessToken,
                ],
            ]);

            return redirect('/dashboard')
                ->with('message', ['type' => 'success', 'text' => 'You are now logged in!']);

        } else {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

    }

}
