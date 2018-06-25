<?php

$selectOption = $_POST['choose'];
$number=$_POST['q#'];
$val=$_POST['updated_value'];
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
    //connect to DB
    $conn = new mysqli($servername, $username, $password,$db);
    // Check connection
		if ($conn->connect_error)
		{
			die("Connection failed: <br>" . $conn->connect_error);
		} 
    //check select option
			if($selectOption=="1")
			{
				$sql = "UPDATE question SET  answer_number='$val' WHERE id='$number'";
			}
			else if($selectOption=="2")
			{
				$sql = "UPDATE question SET  text='$val' WHERE id='$number'";
			}
			else if($selectOption=="3")
			{
				$sql = "UPDATE answer SET  answer_1='$val' WHERE question_id='$number'";
			}
	        else if($selectOption=="4")
			{
				$sql = "UPDATE answer SET answer_2='$val' WHERE question_id='$number'";
			}
			else if($selectOption=="5")
			{
				$sql = "UPDATE answer SET  answer_3='$val' WHERE question_id='$number'";
			}
			else if($selectOption=="6")
			{
				$sql = "UPDATE answer SET  answer_4='$val' WHERE question_id='$number'";
			}
			else if($selectOption=="7")
			{
				$sql = "UPDATE answer SET  answer_5='$val' WHERE question_id='$number'";
			}
			// check query connection
				if ($conn->query($sql) === TRUE) 
                {
					echo "Record updated successfully <br>";
                } 
                    else 
                    {
                        echo "Error updating record: <br>" . $conn->error;
                    }

                $conn->close();

?>