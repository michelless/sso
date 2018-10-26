## Requirements
* Laravel 5 

## Getting Started
1. Install the package by composer.
```
composer require softwareseni/sso
```
2. Add the package to your application service providers in `config/app.php`.
```
'providers' => [
....
	Softwareseni\Sso\SsoServiceProvider::class,

],
```
3. Publish the package
```
php artisan vendor:publish --provider="Softwareseni\SS\SsoServiceProvider"
```
> Once you publish, it publishes the sso configuration file at config path.
4. Add the middleware to your `app/Http/Kernel.php`.
```
protected $routeMiddleware = [

....
	'sso' => \Softwareseni\Sso\Middleware\ClientLogin::class,

];
```
5. Create Oauth Controller
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softwareseni\Sso\SsoClient;
use App\Models\User;

class OauthController extends Controller
{
    function __construct(User $user)
    {
    	$this->user = $user;
    }

    public function callback(Request $request)
    {
    	$sso = new SsoClient();
    	$data = $sso->user($request->token);
	    $user = $this->user->where('email', $data->email)->first();
	    Auth::login($user);

	    return redirect($request->redirect);
    }
}
```
6. Add this code to your web route.
```
Route::get('/oauth/callback', 'OauthController@callback')->name('callback');
```
7. Add this code to your `app/Http/Kernel.php`
```
protected $middlewareGroups = [
        'web' => [
		....
		 \Softwareseni\Sso\Middleware\ClientLogin::class,
        ],
```
