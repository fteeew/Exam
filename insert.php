<?php
$txt=$_POST['question_text'];
$c_a=$_POST['correct_answer'];
$id= $_POST['id'];
include "connect.php";
            function add_answer($last_id)
			{
				include "connect.php";
				if(!empty($_POST['a_1']) &&!empty($_POST['a_2']))
				{
					$a_1=$_POST['a_1'];
                    $a_2=$_POST['a_2'];
					$sq2 ="INSERT INTO answer(q_id,answer,answer_id)
					VALUES ('$last_id','$a_1',1)";
					$sq3 ="INSERT INTO answer(q_id,answer,answer_id)
					VALUES ('$last_id','$a_2',2)";
					echo $conn->query($sq2) === TRUE && $conn->query($sq3) === TRUE ? "insertion answer 1 and answer2 done successfully<br>" : "Error: <br>" . $conn->error;
			    }
				if(!empty($_POST['a_3']))
				{
					$a_3=$_POST['a_3'];
					$sq4 ="INSERT INTO answer(q_id,answer,answer_id)
					VALUES ('$last_id','$a_3',3)";
					echo $conn->query($sq4)=== TRUE ? "insertion done successfully for answer 3<br>" : "Error: <br>" . $conn->error;
				}
				if(!empty($_POST['a_4']))
					
				{
					$a_4=$_POST['a_4'];
					$sq5 ="INSERT INTO answer(q_id,answer,answer_id)
					VALUES ('$last_id','$a_4',4)";
					echo $conn->query($sq5)=== TRUE ? "insertion  done successfully for answer 4<br>" : "Error: <br>" . $conn->error;
				
				}
				if(!empty($_POST['a_5']))
				{
					$a_5=$_POST['a_5'];
					$sq6 ="INSERT INTO answer(q_id,answer,answer_id)
					VALUES ('$last_id','$a_5',5)";
					echo $conn->query($sq6)=== TRUE ? "insertion done successfully for answer 5<br>" : "Error: <br>" . $conn->error;
			    }
			} 
     
	
		if(empty($_POST['question_text']))
		{
			echo "<script type='text/javascript'>alert('required field question text fill it  please');</script>";
				
		}
		else if(empty($_POST['correct_answer']))
		{
			echo "<script type='text/javascript'>alert('required field correct answer fill it please');</script>";
		}
		
	    else
	    {	
            if($id=='!!')
			{
				$w ="INSERT INTO question(text,answer_number)VALUES('$txt','$c_a')";
				echo $conn->query($w)=== TRUE ?"insertion of question text and answer number done successfully  <br>" : "Error: <br>" . $conn->error;
				$last_id = $conn->insert_id;
				echo add_answer($last_id);
				
			
			}
		   if($id!='!!') 
			{
				//echo $id;
				$s="UPDATE question SET  answer_number='$c_a',text='$txt' WHERE id='$id'";
		        $s2="DELETE FROM answer WHERE answer.q_id='$id'";
		        echo $conn->query($s)=== TRUE && $conn->query($s2)=== TRUE ? "update  done successfully for text and answer number<br>" : "Error: <br>" . $conn->error;
				echo add_answer($id);
			}
			$conn->close();
	        echo "<button type=submit onclick=location.href='menu.htm' >return</button>";
		}   
?> 