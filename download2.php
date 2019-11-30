<?php  // phpcs:disable
use Medoo\Medoo;

require 'vendor/autoload.php';
if (!array_key_exists('uuid', $_GET)) {
	return ;
}
$uuid4 = $_GET['uuid'];

include_once 'config.php';

$data = $database->select($table, [
	'id',
	'url',
	'referer',
	'clicked',
	'time',
], [
	'uuid' => $uuid4,
]);
if (!array_key_exists(0, $data)) {
	return ;
}
$s_date = date("Y-m-d H:i:s");
$e_date = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($data[0]['time'])));
if ($e_date < $s_date) {
    return ;
}
$new = $database->update($table, [
	"clicked" => $data[0]['clicked']+1,
], [
	"id" => $data[0]['id']
]);
$filepath = $data[0]['url'];
$file = __DIR__.'/../../../videos/'.basename($filepath);

$fp = @fopen($file, 'rb');
$size = filesize($file); // File size
$length = $size; // Content length
$start = 0; // Start byte
$end = $size - 1; // End byte
header('Content-type: video/mp4');
header("Accept-Ranges: bytes");
if (isset($_SERVER['HTTP_RANGE'])) {
	$c_start = $start;
	$c_end = $end;
	list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
	if (strpos($range, ',') !== false) {
		header('HTTP/1.1 416 Requested Range Not Satisfiable');
		header("Content-Range: bytes $start-$end/$size");
		exit;
	}
	
	if ($range == '-') {
		$c_start = $size - substr($range, 1);
	}else{
		$range = explode('-', $range);
		$c_start = $range[0];
		$c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
	}
	$c_end = ($c_end > $end) ? $end : $c_end;
	
	if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
		header('HTTP/1.1 416 Requested Range Not Satisfiable');
		header("Content-Range: bytes $start-$end/$size");
		exit;
	}
	$start = $c_start;
	$end = $c_end;
	$length = $end - $start + 1;
	fseek($fp, $start);
	header('HTTP/1.1 206 Partial Content');
}
header("Content-Range: bytes $start-$end/$size");
header("Content-Length: ".$length);
$buffer = 1024 * 8;
while(!feof($fp) && ($p = ftell($fp)) <= $end) {
	if ($p + $buffer > $end) {
		$buffer = $end - $p + 1;
	}
	set_time_limit(0);
	echo fread($fp, $buffer);
	flush();
}
fclose($fp);
exit();
?>