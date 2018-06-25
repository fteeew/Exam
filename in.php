<?php
   $key=md5('australia');
   $salt=md5('australia');
   function encrypt($string,$key)
   {
		$string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
		return $string;
   }
   
    session_start();
	
	if(isset($_POST['user_name'])&& isset($_POST['pass']))
	{   
        include "connect.php";
		$q=$_POST['user_name'];
		$encodeString = encrypt($_POST['pass'],$key); 
		$sql = "SELECT * FROM log_in WHERE username ='$q' and pass = '$encodeString'";
		$result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['id'];
        $count = mysqli_num_rows($result);
        if($count == 1) {
			$_SESSION['login_user'] = $active;
			$_SESSION['u_name']=$row['username'];
			if($row['is_admin']=='0')
			{
				header("Location:f.php");
			}
			else
			{
				header("Location:  menu_pdo.php");
			}
         
        }else {
			echo "Your Login Name or Password is invalid";
        }
   
	}

?>