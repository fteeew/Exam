<?php

if(isset($_POST['q_number'])&& isset($_POST['user_answer_number'])&& isset($_POST['u_id']))
{
	
	echo  "<p align='center'>Question " .$_POST['number']." from 20 Questions</p><br><br>";
	echo "" .$_POST['number'] .":";
	echo " ".$_POST['text']." <br> <br><br>" ;
	if($_POST['a_1']==$_POST['user_answer_number'])
	{
		
		echo "<input type='radio' CHECKED/>".$_POST['a1']."</input><br/><br/>";
	}
	else
	{
		echo "<input type='radio'>".$_POST['a1']."</input><br/><br/>";
	}
	if($_POST['a_2']==$_POST['user_answer_number'])
	{
		echo "<input type='radio' CHECKED/>".$_POST['a2']." </input><br/><br/>";
	}
	else
	{
		echo "<input type='radio'>".$_POST['a2']."</input><br/><br/>";
	}
	if(!empty($_POST['a3']))
	{
		if($_POST['a_3']==$_POST['user_answer_number'])
		{
			
			echo "<input type='radio' CHECKED/>".$_POST['a3']." </input><br/><br/>";
		}
		else
		{
			echo "<input type='radio'>".$_POST['a3']."</input><br/><br/>";
		}
	}
	if(!empty($_POST['a4']))
	{
		if($_POST['a_4']==$_POST['user_answer_number'])
		{
			echo "<input type='radio' CHECKED/>".$_POST['a4']." </input><br/><br/>";
		}
		else
		{
			echo "<input type='radio'>".$_POST['a4']."</input><br/><br/>";
		}
		
	}
	if(!empty($_POST['a5']))
	{
		if($_POST['a_5']==$_POST['user_answer_number'])
		{
			echo "<input type='radio' CHECKED/>".$_POST['a5']." ></input><br/><br/>";
		}
		else
		{
			echo "<input type='radio'>".$_POST['a5']."</input><br/><br/>";
		}
	}
	
	include "connect.php";
	$sq1 ="update user_answer set answer_number="$_POST['user_answer_number']" where user_id="$_POST['u_id']" and question_number="$_POST['q_number']"";
	

if ($conn->query($sql) === TRUE) 
{
  //  echo "Record updated successfully <br>";
} 
else 
{
    echo "Error updating record: <br>" . $conn->error;
}
}
$conn->close();

?>