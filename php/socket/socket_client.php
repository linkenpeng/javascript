<?php
//The Client
error_reporting(E_ALL);
set_time_limit(0);

include 'SocketUtils.php';

$address = "127.0.0.1";
$port = "10000";

$address = "192.168.5.50";
$port = 12239;

$address = "211.147.242.94";
$port = 20232;


$socket = new SocketUtils($address, $port);
$socket->clientConn();
$socket->write('23');
$result = $socket->read(2048);
$socket->close();

echo $result;
?> 