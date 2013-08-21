<?php
//The Server
error_reporting(E_ALL);

include 'SocketUtils.php';

$address = "127.0.0.1";
$port = 10000;

// ����
$serverSocket = new SocketUtils($address, $port);
$serverSocket->serverListen();

while (true) {
	$client = $serverSocket->getClient(); // �õ��ͻ��˷���
	if($client) {
		$clientRequest = $serverSocket->read(2048, $client);
		echo 'Client Request is: '.$clientRequest.'<br />';
		
		if($clientRequest) {
			// ���������ظ��ͻ���
			$response = 'Server Response is: '.'Hello Client.'.'<br />';
			$serverSocket->write($response, $client);
		}
	}
}

// �ر�
$serverSocket->close($client); 	// �رտͻ���
$serverSocket->close(); 		// �رշ�����
?> 
