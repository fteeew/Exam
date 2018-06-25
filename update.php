<?php

$selectOption = $_POST['choose'];
$number=$_POST['q#'];
$val=$_POST['updated value'];
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
  if ($conn->connect_error)
	{
		die("Connection failed: <br>" . $conn->connect_error);
    } 
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
		$sql = "UPDATE question SET  answer_1='$val' WHERE id='$number'";
	}
	else if($selectOption=="4")
	{
		$sql = "UPDATE question SET answer_2='$val' WHERE id='$number'";
	}
	else if($selectOption=="5")
	{
		$sql = "UPDATE question SET  answer_3='$val' WHERE id='$number'";
	}
	else if($selectOption=="6")
	{
		$sql = "UPDATE question SET  answer_4='$val' WHERE id='$number'";
	}
	else if($selectOption=="7")
	{
		$sql = "UPDATE question SET  answer_5='$val' WHERE id='$number'";
	}
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