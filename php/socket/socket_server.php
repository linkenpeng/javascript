<?php
//The Server
error_reporting(E_ALL);

include 'SocketUtils.php';

$address = "127.0.0.1";
$port = 10000;

// 监听
$serverSocket = new SocketUtils($address, $port);
$serverSocket->serverListen();

while (true) {
	$client = $serverSocket->getClient(); // 得到客户端返回
	if($client) {
		$clientRequest = $serverSocket->read(2048, $client);
		echo 'Client Request is: '.$clientRequest.'<br />';
		
		if($clientRequest) {
			// 服务器返回给客户端
			$response = 'Server Response is: '.'Hello Client.'.'<br />';
			$serverSocket->write($response, $client);
		}
	}
}

// 关闭
$serverSocket->close($client); 	// 关闭客户端
$serverSocket->close(); 		// 关闭服务器
?> 
