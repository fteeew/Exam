<!DOCTYPE html>
<html>
<body>
<style>
body
{
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
    font-size: 20px;	
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
<h3 id=headder>Are you sure you want to delete this question click submit to continue?</h3>
<?php
    
	$q = $_GET['id']; 
	try 
	{
		include "conn.php";
	    $sql = "SELECT question.id,question.text,question.answer_number FROM question where question.id=:u and user_id=:u1";
	    $stmt = $conn->prepare($sql);
		$stmt->bindParam(':u', $q, PDO::PARAM_INT); 
		$stmt->bindParam(':u1',$user_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetchObject();
		echo  "<p id='de'>" . $row->text. "</p>";
		echo "<input type='hidden' id='q_id' value='". $row->id."'>";
		$sq2="SELECT answer from answer WHERE q_id= :y ";
		$stmt = $conn->prepare($sq2);
		$stmt->bindParam(':y',$row->id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$c = 1;
		$v=2;
		
		foreach($result as $r)
		{
		
			echo "<input type='radio' name='$c' id='answer_$c' value='id='$c''><span id='an_$v'>" . $r["answer"]. "</span></input><br/>";
			$c += 1;
			$v += 1;
		}
		echo "<input type='hidden' id='q_id' value='". $q."'>";
		echo "<input type='submit' id='delete' onclick='myFunction();'>";		
	}
	catch(PDOException $e)
    {
		echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;
	
?>			
	<div id="result"></div>
<p id="demo"></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	function myFunction() 
	{
	
		var i=$('#q_id').val();	
		var txt;
		var r = confirm("are you sure?!");
		if (r == true) 
		{
			$('#headder').hide();
			$('#de').hide();
			$('#answer_1').hide();
            $('#an_2').hide();
			$('#answer_2').hide();
            $('#an_3').hide();
			$('#answer_3').hide();
            $('#an_4').hide();
			$('#answer_4').hide();
            $('#an_5').hide();
			$('#answer_5').hide();
            $('#an_6').hide();
			$('#delete').hide();
			
			$.post('delete_PDO.php',{id:i},function(data){
			$('#result').html(data);
		});
		}
		else
		{
			txt = "You pressed Cancel! the question will not be delete";
			document.getElementById("demo").innerHTML = txt;
		}           
    }
</script>
</body>
</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	