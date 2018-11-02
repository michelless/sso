<?php
Route::get('sso', function(){
	echo 'Hello from the sso package!';
});

Route::get('oauth/callback/{token}’, ‘Ss\SsoClient@callback');