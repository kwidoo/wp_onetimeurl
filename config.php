<?php
//phpcs:disable

use GuzzleHttp\Client;
use Medoo\Medoo;

$database = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'turk',
	'server' => '127.0.0.1',
	'username' => 'turk',
	'password' => 'jsdOj7GiTFDZ79p7A42'
]);

$client = new Client(
	array(
		'base_uri' => 'https://player.vimeo.com/video/',
	)
);