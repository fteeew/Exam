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
		$q=$_POST['id']; 
		include "connect.php";;
	    $s="DELETE FROM answer WHERE answer.q_id=$q";
	    $s2 = "DELETE FROM question WHERE  question.id=$q";
		echo $conn->query($s)=== TRUE && $conn->query($s2)=== TRUE ? "deletion done successfully<br>" : "Error: <br>" . $conn->error;
		echo "<button type=submit onclick=location.href='menu.htm' >return</button>";	
   
	
?>			
	
