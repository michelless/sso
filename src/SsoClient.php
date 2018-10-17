<?php
namespace Softwareseni\Sso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class SsoClient extends Controller
{
    public function callback($token)
    {
    	$configs = include __DIR__.'/../config/sso.php';
    	$client = new Client();
    	$headers = [
		    'Authorization' => 'Bearer ' . $token,   
		];
		$response = $client->request('GET', $configs['host'], [
	        'headers' => $headers
	    ]);
	    // $data = json_decode($response->getBody());
	    $data = json_decode($response->getBody());
	    return $data;
    }
}
