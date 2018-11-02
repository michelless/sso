<?php
namespace Softwareseni\Sso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class SsoClient extends Controller
{
    public function redirect()
    {
    	$app_id = config('sso.app_id');
    	$app_secret = config('sso.app_secret');
    	$redirect = config('sso.redirect');
    	$url = config('sso.url')."oauth/login";

    	return redirect($url.'?app_id='.$app_id.'&app_secret='.$app_secret.'&redirect='.$redirect);
    }

    public function user($token)
    {
    	$client = new Client();
    	$headers = [
		    'Authorization' => 'Bearer ' . $token,   
		];
        try {
    		$response = $client->request('GET', config('sso.url')."api/user", [
    	        'headers' => $headers
    	    ]);
            
            $data = json_decode($response->getBody());
            return array([
                'status'  => true,
                'data' => $data
            ], 200);
        } catch (RequestException $e) {
            // echo Psr7\str($e->getRequest());
            return array([
                'status'  => false,
                'message' => 'Invalid token.'
            ], 500);
            if ($e->hasResponse()) {
                // echo Psr7\str($e->getResponse());
                return array([
                    'status'  => false,
                    'message' => 'Invalid token.'
                ], 500);
            }
        }
	    // $data = json_decode($response->getBody());
    }
}
