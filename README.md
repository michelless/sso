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
5. Add this code to your web route.
```
Route::get('/login')->middleware('sso');
```
