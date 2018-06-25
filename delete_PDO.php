<!DOCTYPE html>
<html>
<body>
<style>
body
{
	background-color:white;
	color:#123456;
	box-shadow:0px 0px 1px 1px black;
	font-Weight:400;
	width:350px;
	margin:10px 210px 0 10px;
	float:left;
	height:570px;
}
</style>
<body>
</div>
</body>
</html>
<?php
    session_start();
    $user_id=$_SESSION['login_user'];
	$q=$_POST['id']; 
	if ($user_id !="") {
		try 
		{
			//echo $q; 
			//echo  $user_id;
			include "conn.php";
			$s="DELETE FROM question WHERE id=:ID and user_id=:u1";
			$stmt = $conn->prepare($s);
			$stmt->bindParam(':ID',$q, PDO::PARAM_INT);
			$stmt->bindParam(':u1',$user_id, PDO::PARAM_INT);
			$stmt->execute();
			echo "deletion done successfully<br>";
		} 
		
		catch(PDOException $e)
		{
			echo  "eroor <br>" . $e->getMessage();
		}
	}
	else
	{
		header("Location: log_in.html");
	}
	$conn = null;
	
?>			
	
