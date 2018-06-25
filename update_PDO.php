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
$i=$_POST['id'];
$p=$_POST['question_text'];
$p1=$_POST['correct_answer'];
$e1=$_POST['a_1'];
$e2=$_POST['a_2'];
if ($user_id !="") {
	try 
	{
		include "conn.php";
		if(empty($p))
		{
			echo "<script type='text/javascript'>alert('required field question text fill it please');</script>";
			
		}
		else if(empty($p1))
		{
			echo "<script type='text/javascript'>alert('required field correct answer fill it please');</script>";
		}
		else if(empty($e1))
		{
			echo "<script type='text/javascript'>alert('required field answer 1 fill it please');</script>";
		}
		else if(empty($e2))
		{
			echo "<script type='text/javascript'>alert('required field answer 2 fill it please');</script>";
		}
		else if ($p1>5||$p1<=0)
		{
			echo "<script type='text/javascript'>alert('error!correct answer is a numbe from 1 to 5 ,try again');</script>";
		}
		else
		{	
		    //$s="UPDATE question SET  answer_number='$p1',text='$p' WHERE id='$i'";
			$s="UPDATE question SET  answer_number= :a,text= :t WHERE id= :q_id and user_id=:u1";
			$stmt = $conn->prepare($s);
			$stmt->bindParam(':a',$p1, PDO::PARAM_INT);       
            $stmt->bindParam(':t',$p, PDO::PARAM_STR);    
            $stmt->bindParam(':q_id',$i, PDO::PARAM_INT);
			$stmt->bindParam(':u1',$user_id, PDO::PARAM_INT);
			$stmt->execute();
			$s2="DELETE FROM answer WHERE answer.q_id='$i'";
			echo "update  done successfully for text and answer number<br>";
			$conn->exec($s2);
		   if (isset($e1))
		   { 
				
				$sq3 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a5,1)");
			    $sq3->bindParam(':id',$i,PDO::PARAM_INT);
				$sq3->bindParam(':a5',$e1,PDO::PARAM_STR);
				$sq3->execute();
				echo "update  done successfully for answer 1<br>";
		   
		   }
		   if (isset($e2))
		   { 
				
				$sq4 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a5,2)");
			    $sq4->bindParam(':id',$i,PDO::PARAM_INT);
				$sq4->bindParam(':a5', $e2,PDO::PARAM_STR);
				$sq4->execute();
				echo "update  done successfully for answer 2<br>";
	

		   }
		   if (isset($_POST['a_3'])&& !empty($_POST['a_3']))
			{   
				$e3=$_POST['a_3'];
				$sq5 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a5,3)");
			    $sq5->bindParam(':id',$i,PDO::PARAM_INT);
				$sq5->bindParam(':a5', $e3,PDO::PARAM_STR);
				$sq5->execute();
				echo "update  done successfully for answer 3<br>";

            }
		    if (isset($_POST['a_4'])&& !empty($_POST['a_4']))
			{
				$e4=$_POST['a_4'];
				$sq6 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a5,4)");
			    $sq6->bindParam(':id',$i,PDO::PARAM_INT);
				$sq6->bindParam(':a5', $e4,PDO::PARAM_STR);
				$sq6->execute();
				echo "update  done successfully for answer 4<br>";
				
			}
			if (isset($_POST['a_5'])&& !empty($_POST['a_5']))
			{		
				$e5=$_POST['a_5'];
				$sq7 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a5,5)");
			    $sq7->bindParam(':id',$i,PDO::PARAM_INT);
				$sq7->bindParam(':a5', $e5,PDO::PARAM_STR);
				$sq7->execute();
				echo "update  done successfully for answer 5<br>";
				
			}
       }
    } 
	
	catch(PDOException $e)
    {
		echo "Error: ". "<br>" . $e->getMessage();
    }
}
else{
	header("Location: log_in.html");
}
	$conn = null;
	?>