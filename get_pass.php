<?php
    
	$key=md5('australia');
	$salt=md5('australia');
	function decrypt($string,$key)
	{
		$string=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB));
		return $string;
	}
    include "conn.php";
	$sq2="SELECT * from log_in WHERE email=:y";
	$stmt = $conn->prepare($sq2);
	$stmt->bindParam(':y',$_POST['email'], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetchObject();
    $pass=$row->pass;
    $r=decrypt($pass,$key);
	echo "your password is:<br>";
	echo $r;
	echo "<br><br><b>sign in now:</b><a href='log_in.html'>  sign in</a>";

?>