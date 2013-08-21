<?php
class SocketUtils {
	private $address; // ip地址
	private $port;	  // 端口
	private $socket;  // 连接资源
	
	function __construct($address, $port) {
		$this->address = $address;
		$this->port = $port;
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	}
	
	// 客户端连接
	public function clientConn() {		
		$result = socket_connect($this->socket, $this->address, $this->port);
		if ($result === false) {
			exit('无法连接服务器');
		}
		return $result;
	}
	
	// 服务器监听
	public function serverListen() {
		socket_bind($this->socket, $this->address, $this->port);
		socket_listen($this->socket, 5);
	}
	
	// 服务器得到客户端对象
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