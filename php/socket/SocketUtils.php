<?php
class SocketUtils {
	private $address; // ip��ַ
	private $port;	  // �˿�
	private $socket;  // ������Դ
	
	function __construct($address, $port) {
		$this->address = $address;
		$this->port = $port;
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	}
	
	// �ͻ�������
	public function clientConn() {		
		$result = socket_connect($this->socket, $this->address, $this->port);
		if ($result === false) {
			exit('�޷����ӷ�����');
		}
		return $result;
	}
	
	// ����������
	public function serverListen() {
		socket_bind($this->socket, $this->address, $this->port);
		socket_listen($this->socket, 5);
	}
	
	// �������õ��ͻ��˶���
	public function getClient() {
		return socket_accept($this->socket);
	}
	
	public function write($str, $socket = null) {
		$s = $socket ? $socket : $this->socket;
		socket_write($s, $str, strlen($str));
	}
	
	public function read($strlen, $socket = null) {
		$s = $socket ? $socket : $this->socket;
		return socket_read($s, $strlen);
	}
	
	public function close($socket = null) {
		$s = $socket ? $socket : $this->socket;
		if($s) {
			socket_close($s);
		}
	}
}

?>