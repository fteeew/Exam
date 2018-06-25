<html>
<style>
body {
    border: 5px solid #ccc;
     width:960px;
      margin:0 auto;
      padding:10px 25px;
      background:#fff;
      font-style: italic;
       font-size: 18px;	  
}
h3
{
	color:black;
	background-color:#ccc;
	text-align:center;
	width:100%;
	height:50px;
	padding-top:10px;
	font-style: italic;
    font-size: 40px;	
}


</style>
<?php
    session_start();
	$user_id=$_SESSION['login_user'];
	echo "<p align='center'> Hello ".$_SESSION['u_name']."</p><br>";
	?>
<body>
<a href='menu_pdo.php'><b>Main</b></a>
<a style="float: right;" href='log_out.php'><b>LOG OUT</b></a>

<h3> Questions</h3>
<p > Note: the correct answer has the sign **</p>
</div>
</body>
</html>

<?php

	$i=1;
    $n=1;
	if($user_id !=null)
	{	
	try 
	{
		include "conn.php";
		$sql = "SELECT question.id,question.text,question.answer_number FROM question where user_id=:u1";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':u1',$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
		
	    foreach($result as $row)
		{
			echo  "" .$i. ": " . $row["text"]. "<br><br>";
			$answer=$row["answer_number"];
			
			//$w="SELECT answer,answer_id from answer WHERE q_id='".$row["id"]."'order by answer";
			$w="SELECT answer,answer_id from answer WHERE q_id=:u order by answer";
			$stmt = $conn->prepare($w);
			$stmt->bindParam(':u',$row["id"], PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach($result as $r)
			{
				echo "</br>";
				$n=$r["answer_id"];
                if($n==$answer)
				{
					echo "<input type='radio' value='".$r["answer"]."'>". $r["answer"]."**</input><br/>";	
				}
				else
				{
					echo "<input type='radio'  value='".$r["answer"]."'>". $r["answer"]."</input><br/>";
				}
				
			}
			$i=$i+1;
            echo "<br>";
			echo "<button type=submit onclick=location.href='d_PDO.php?id=" . $row["id"]."' id=delete >delete</button>";
			echo "<button type=submit onclick=location.href='e_PDO.php?id=" . $row["id"]."' id=update >update</button>";
		    echo "<br>-------------------------------------------------<br>";		
			
        }
		
		
		
		
	}
	
	catch(PDOException $e)
    {
		echo $sql . "<br>" . $e->getMessage();
    }
	}
	else
	{
		
		header("Location: log_in.html");
	}

	$conn = null;
	
?>			
	