<?php
    $key=md5('australia');
   $salt=md5('australia');
   function encrypt($string,$key)
   {
		$string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
		return $string;
   }
	include "conn.php";
	$u=$_POST['user_name'];
    $p=$_POST['pass'];
    $e=$_POST['email'];
	if(isset($_POST['user_name'])&& isset($_POST['pass'])&& isset($_POST['email']))
	{
		if(!empty($u)&& !empty($p)&&!empty($e))
		{     
	        $encodeString = encrypt($p,$key);
			$s =$conn->prepare("INSERT INTO log_in(username,pass,email,is_admin)VALUES(:r,:r1,:r2,0)");
			$s->bindParam(':r',$u,PDO::PARAM_STR);
			$s->bindParam(':r1',$encodeString,PDO::PARAM_STR);
			$s->bindParam(':r2',$e,PDO::PARAM_STR);
			$s->execute();
			echo  "you are a registered user now<br>";
			echo "you have to sign in now click the link below <br>";
			echo "<br><b> already a member:</b><a href='log_in.html'>sign in</a>";
		}
    }
	
?>