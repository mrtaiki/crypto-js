<?php
	session_start();
	$user=openssl_decrypt($_POST['user'],'aes-256-cbc',$_SESSION['AES_KEY'],0,$_SESSION['AES_IV']);  
	$pw=openssl_decrypt($_POST['pw'],'aes-256-cbc',$_SESSION['AES_KEY'],0,$_SESSION['AES_IV']);  
	echo 'user name:',$user;
	echo '<br>';
	echo 'password:',$pw;
?>
