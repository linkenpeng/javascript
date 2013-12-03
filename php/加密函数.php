<?php

/**
 * 用户密码加密
 * @param $password 用户明文密码
 * @param $salt 用户密码钥匙 对应users表中的salt字段
 */
protected function generatePassword($password, $salt) {
	return md5(md5($password) . $salt);
}

/**
 * 账号密码加密
 * @param $txt 明文密码
 * @param $key 加密密匙，为：
 */
public static function passport_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(self::passport_key($tmp, $key));
}

/**
 * 账号密码解密
 * @param $txt 加密后的密码
 * @param $key 解密密匙，为：
 */
public static function passport_decrypt($txt, $key) {
	$txt = self::passport_key(base64_decode($txt), $key);
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

//加密解密辅助函数
public static function passport_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}