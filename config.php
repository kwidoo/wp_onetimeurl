<?php //phpcs:disable

use GuzzleHttp\Client;
use Medoo\Medoo;

require( __DIR__ . '../../../../wp-config.php' );

$database = new Medoo([
	'database_type' => 'mysql',
	'database_name' => DB_NAME,
	'server' => DB_HOST,
	'username' => DB_USER,
	'password' => DB_PASSWORD,
]);

$table = $table_prefix.'otu_mapping';

