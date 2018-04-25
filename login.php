<?php
	session_start();
	$bytes = openssl_random_pseudo_bytes(16);
	$_SESSION['AES_KEY']=bin2hex($bytes);
	$bytes = openssl_random_pseudo_bytes(8);
	$_SESSION['AES_IV']=bin2hex($bytes);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>SSO demo</title>
		<script src="./crypto-js-min.js"></script>
		<script>
		function  AES_encrypt(data){
			var key = CryptoJS.enc.Utf8.parse('<?php echo $_SESSION['AES_KEY'];?>');
			var iv=CryptoJS.enc.Utf8.parse('<?php echo $_SESSION['AES_IV'];?>');
			return CryptoJS.AES.encrypt(data, key, { iv: iv,});
		}
		function _login()
		{
			var f_user=document.getElementById('user');
			var f_pw=document.getElementById('pw');
			f_user.value=AES_encrypt(f_user.value);
			f_pw.value=AES_encrypt(f_pw.value);
			document.getElementById('frm_log').submit();
		}
		</script>
	</head>
<body>
	<form id="frm_log" method="post" action="auth.php">
		<input type="text" id="user" name="user" value=""><br/>
		<input type="password" id="pw" name="pw" value=""><br/>
		<input type="button" value="login" onclick="_login();">
	</form>
</body>
</html>