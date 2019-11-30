<?php  // phpcs:disable

use GuzzleHttp\Client;
use Medoo\Medoo;

require 'vendor/autoload.php';

if (!array_key_exists('uuid', $_GET)) {
	return ;
}
$uuid4 = $_GET['uuid'];

include_once 'config.php';

$client = new Client(
	array(
		'base_uri' => 'https://player.vimeo.com/video/',
	)
);

$data = $database->select('wp_bzvmqg_otu_mapping', [
	'id',
	'url',
	'referer',
	'clicked',
], [
	'uuid' => $uuid4,
]);
if (!array_key_exists(0, $data)) {
	return ;
}

if ($data[0]['clicked'] == true) {
	return ;
}
$new = $database->update("wp_bzvmqg_otu_mapping", [
	"clicked" => 1
], [
	"id" => $data[0]['id']
]);

$url = explode('/', $data[0]['url']);
$response = $client->request(
	'GET',
	$url[count($url)-1],
	array(
		'headers' => array(
			'Referer' => $_SERVER['SERVER_ADDR'] == '127.0.0.1' ? "https://turk-flix.xyz/" : $_SERVER['HTTP_REFERER'],
			'Accept'  => 'text/html;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
			'Accept-Encoding' => 'gzip, deflate, br',
			'Accept-Language' => 'ru,lv;q=0.9,en-US;q=0.8,en;q=0.7',
			'Cache-Control' => 'no-cache',
			'Connection' => 'keep-alive',
			//'Host' => 'player.vimeo.com',
			'Pragma' => 'no-cache',
			'Sec-Fetch-Mode' => 'nested-navigate',
			'Sec-Fetch-Site' => 'cross-site',
			'Upgrade-Insecure-Requests' => 1,
			'User-Agent' => $_SERVER['HTTP_USER_AGENT']
			,
		),
	)
);

echo $response->getBody()->getContents();
?>
