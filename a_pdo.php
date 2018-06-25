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
		width:350px;
		margin:10px 210px 0 10px;
		float:left;
		height:570px;
	}
	#form div
	{
		padding:10px 0 0 30px;
	}
	h3
	{
		margin-top:0px;
		color:black;
		background-color:#ccc;
		text-align:center;
		width:100%;
		height:50px;
		padding-top:10px;
	}
	#mainform
	{
		width:560px;
		margin:20px auto;
		padding-top:20px;
		font-family: 'Fauna One', serif;
	}
	input
	{
		width:90%;
		margin-top:10px;
		border-radius:3px;
		padding:2px;
		box-shadow:0px 1px 1px 0px darkgray;
	}
	.innerdiv
	{
		width:65%; float:left;
	}
	input[type=submit]
	{
		height:50px;
		background-color:#ccc;
		border:1px solid white;
		font-family: 'Fauna One', serif;
		font-Weight:bold;
		font-size:18px;
		color:black;
	}
	.error {color: #FF0000;}
	</style>
</head>
<body>
<?php 
	 session_start();
	$user_id=$_SESSION['login_user'];
	if ($user_id !="") {
		echo "<p align='center'> Hello ".$_SESSION['u_name']."<br></p>";
?>
    
    <a href='menu_pdo.php'><b>Main</b></a>
    <a style="float: right;" href='log_out.php'><b>LOG OUT</b></a>
		<div id="mainform">
			<div class="innerdiv">
				<h3>add question to database</h3>	
				<form action="add_PDO.php" method="POST" id="form" name="form">
					<div>
					   <p><span class="error">* required field.</span></p>
						<b>question text:</b>
						<span class="error">*</span><br>
						<input type='hidden' id='id' name='id' value='!!'>
						<textarea id="question_text" class="error" name="question_text" rows="5" cols="40"></textarea><br>
						<label><b>correct answer is</b></label>
						<span class="error">*enter number from 1 to 5</span><br>
						<input type="text" id="correct_answer" class="error" name="correct_answer">
						<b>answer choice 1:</b>
						<span class="error">*</span><br>
						<textarea name="a_1" id="a_1" class="error" rows="2" cols="30"></textarea><br>
						<b>answer choice 2:</b>
						<span class="error">*</span><br>
						<textarea name="a_2" id="a_2" class="error" rows="2" cols="30"></textarea><br>
						<b>answer choice 3:</b><br>
						<textarea name="a_3" rows="2" id='a_3' cols="30"></textarea><br>
						<b>answer choic 4:</b><br>
						<textarea name="a_4" rows="2" id='a_4' cols="30"></textarea><br>
						<b>answer choice 5:</b><br>
						<textarea name="a_5" rows="2" id='a_5' cols="30"></textarea><br>
						<input type="submit" id="submit"></input>
						
					<div>
				</form>
			</div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#submit").click(function(){
 
 
				var a_1=$('#question_text').val();
				var a_2=$('#correct_answer').val();
				var a_3=$('#a_1').val();
				var a_4=$('#a_2').val();
				var a_5=$('#a_3').val();
				var a_6=$('#a_4').val();
				var a_7=$('#a_5').val();
				
				var empty_answer=0;
				if(a_1==null ||a_1.trim()=='')
				{ 
					alert("question text is required field please fill it ");
					return false;
				}
				
				if(a_2==null ||a_2.trim()=='')
				{ 
					alert("correct answer is required field please fill it ");
					return false;
				}
				
				if(a_3==null ||a_3.trim()=='')
				{ 
					alert("answer 1 is required field please fill it ");
					empty_answer=empty_answer+1;
					return false;
				}
			
				if(a_4==null ||a_4.trim()=='')
				{ 
					alert("answer 2 is required field please fill it ");
					empty_answer=empty_answer+1;
					return false;
				}
				if(a_5==null || a_5.trim()=='')
				{ 
					empty_answer=empty_answer+1;
				
				}
				if(a_6==null || a_6.trim()=='')
				{ 
					empty_answer=empty_answer+1;
				
				}
				if(a_7==null || a_7.trim()=='')
				{ 
					empty_answer=empty_answer+1;
				
				}
				var inserted_answer=5-empty_answer;
				 //alert(inserted_answer);
				if(a_2>inserted_answer)
				{
					alert('the correct answer is invalid ');
					return false;
				}
				if (a_2 > 5 || a_2 < 0) 
				{
					alert('error should be a number from 1 to 5');
					return false;
				}
				
				
				if (a_2.match(/[a-z]/i))
				{
					alert('error correct answer should not caontain any character'); 
					return false;
				}
				
				
			if (a_3.trim() == a_4.trim())
			{
				alert(' error two answers are equal'); 
				return false;
				
			}
			if(a_5!=null ||a_5.trim()!='')
			{
				if (a_4.trim() == a_5.trim()||a_3.trim() == a_5.trim())
				{
					alert('error two answers are equal'); 
					return false;
						
				}
				if(a_6!='')
				{
					if (a_5.trim() == a_6.trim())
					{
						alert('error two answers are equal');
                        return false;						
					
					}
				}
				if(a_7!='')
				{
					if (a_5.trim() == a_7.trim())
					{
						alert('error two answers are equal'); 
						return false;
					
					}
				}
			}
			if(a_6!=null ||a_6.trim()!='')
			{
				if (a_4.trim() == a_6.trim()||a_3.trim() == a_6.trim())
				{
					alert('error two answers are equal'); 
					return false;
					
				}
				if(a_7!='')
				{
					if (a_6.trim() == a_7.trim())
					{
						alert('error two answers are equal'); 
						return false;
					
					}	
				}
			}
			if(a_7!=null ||a_7.trim()!='')
			{
				if (a_3.trim() == a_7.trim()||a_4.trim() == a_7.trim())
				{
					alert('error two answers are equal');
					return false;					
				}
			}				
});
});
</script>		
<?php 
	} else {
		header("Location: log_in.html");
	}
?>
</body>
</html>
