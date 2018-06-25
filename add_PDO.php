<?php
	session_start();
	echo "<p align='center'> Hello ".$_SESSION['u_name']."</p><br>";
	echo "<a href='menu_pdo.php'><b>Main</b></a>
	<a style='float: right;' href='log_out.php'><b>LOG OUT</b></a><br>";
	$txt=$_POST['question_text'];
	$c_a=$_POST['correct_answer'];
	$a_1=$_POST['a_1'];
	$a_2=$_POST['a_2'];
	$a_3=$_POST['a_3'];
	$a_4=$_POST['a_4'];
	$a_5=$_POST['a_5'];
	$user_id=$_SESSION['login_user'];
	if ($user_id !="") {
		try 
		{
			include "conn.php";
			if(empty($txt))
		    {
				echo "<script type='text/javascript'>alert('required field question text fill it  please');</script>";
				
			}
			else if(empty($c_a))
			{
				echo "<script type='text/javascript'>alert('required field correct answer fill it please');</script>";
			}
			else if(empty($a_1))
			{
				echo "<script type='text/javascript'>alert('required field answer 1 fill it please');</script>";
			}
			else if(empty($a_2))
			{
				echo "<script type='text/javascript'>alert('required field answer 2 fill it please');</script>";
			}
			else
			{	
				
				$sq1 =$conn->prepare("INSERT INTO question (text,answer_number,user_id)VALUES (:text,:answer_number,:u)");
				$sq1->bindParam(':text',$txt,PDO::PARAM_STR);
				$sq1->bindParam(':answer_number', $c_a,PDO::PARAM_INT);
				$sq1->bindParam(':u',$user_id,PDO::PARAM_INT);
				$sq1->execute();
				echo "insertion of question text,correct answer done successfully<br>";
				
				$last_id = $conn->lastInsertId();
				$sq2 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a1,1)");
				$sq2->bindParam(':id',$last_id,PDO::PARAM_INT);
				$sq2->bindParam(':a1',$a_1,PDO::PARAM_STR);
				$sq2->execute();	
				echo "insertion of answer 1 done successfully<br>";
				
				$sq3 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
				VALUES (:id,:a2,2)");
				$sq3->bindParam(':id',$last_id,PDO::PARAM_INT);
				$sq3->bindParam(':a2',$a_2,PDO::PARAM_STR);
				$sq3->execute();
				echo "insertion of answer 2 done successfully<br>";
				if(!empty($a_3))
				{
					$sq4 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
					VALUES (:id,:a3,3)");
					$sq4->bindParam(':id',$last_id,PDO::PARAM_INT);
					$sq4->bindParam(':a3', $a_3,PDO::PARAM_STR);
					$sq4->execute();
					echo "insertion of answer 3 done successfully<br>";
				}
				if(!empty($a_4))
				{
					$sq5 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
					VALUES (:id,:a4,4)");
					$sq5->bindParam(':id',$last_id,PDO::PARAM_INT);
					$sq5->bindParam(':a4', $a_4,PDO::PARAM_STR);
					$sq5->execute();
					echo "insertion of answer 4 done successfully<br>";
				}
				if(!empty($a_5))
				{
					$sq6 =$conn->prepare("INSERT INTO answer(q_id,answer,answer_id)
					VALUES (:id,:a5,5)");
					$sq6->bindParam(':id',$last_id,PDO::PARAM_INT);
					$sq6->bindParam(':a5', $a_5,PDO::PARAM_STR);
					$sq6->execute();
					echo "insertion of answer 5 done successfully<br>";
				}
										
			}
										
								
			} 
	
	    catch(PDOException $e)
        {
			echo "Error: ". "<br>" . $e->getMessage();
        }
	}
	else
	{
		header("Location: log_in.html");
	}
	$conn = null;
	
	?>