<!DOCTYPE html>
<html>
<head>
<style>
#form
{
	background-color:white;
	color:#123456;
	box-shadow:0px 0px 1px 1px black;
	font-Weight:400;
	width:346px;
	margin:250px 500px;
	float:left;
	height:50px;
}
.btn-group .button {
    background-color: #4CAF50; /* Green */
    border: 1px solid green;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    float: left;

}
.btn-group .button:not(:last-child)
{
    border-right: none; /* Prevent double borders */
}
.btn-group .button:hover {
    background-color: #3e8e41;
}

</style>
</head>
<body>
<?php 
	session_start();
	$user_id=$_SESSION['login_user'];
	if ($user_id !="") {
		echo "<p align='center'> Hello ".$_SESSION['u_name']." </p>";
?>
<p align="right"><a href='log_out.php'><b>LOG OUT</b></a><br></p>
    <div name="form" id="form">
		<div class="btn-group" >

			<button class="button"  onclick="location.href='a_pdo.php'">ADD</button>
			<button type="submit"   class="button" onclick="location.href='show_PDO.php'">SHOW</button>
            <button type="submit"   class="button" onclick="location.href='f_admin.php'">do a quiz</button>

		</div>
	</div>
<?php 
	} else {
	header("Location: log_in.html");
	//echo "ghh";
	}
?>
</body>
</html>

