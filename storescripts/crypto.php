<?php  
function encryptIT($q){
	$cryptkey = 'jjUB328DJBnbdkmsadJJK232JNkjk1319432jjjhbB';
	$qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptkey), $q, MCRYPT_MODE_CBC, md5(md5($cryptkey))));
	return ($qEncoded);
}
function decryptIT($q){
	$cryptkey = 'jjUB328DJBnbdkmsadJJK232JNkjk1319432jjjhbB';
	$qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptkey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptkey))), "\0");
	return ($qDecoded);
}
?>