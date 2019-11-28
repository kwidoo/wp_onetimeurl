<?php  // phpcs:disable

use GuzzleHttp\Client;
use Medoo\Medoo;

require 'vendor/autoload.php';

if (!array_key_exists('uuid', $_GET)) {
	return ;
}
$uuid4 = $_GET['uuid'];

include_once 'config.php';

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
			'Referer' => 'https://turk-flix.xyz/',//$data[0]['referer'],//sahsiyet-episode-12-english-subtitles/',
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
			'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
		),
	)
);

echo $response->getBody()->getContents();
?>