<?php

return [
	'default' => [
		'host'     => env('DIRECTADMIN_HOST',null),
		'domain'   => env('DIRECTADMIN_DOMAIN',null),
		'username' => env('DIRECTADMIN_USERNAME',null),
		'password' => env('DIRECTADMIN_PASSWORD',null),
		'cacert'   => env('DIRECTADMIN_CACERT','cacert.pem'),
	]
];
