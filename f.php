
<html>
<style>
body {
    border: 5px solid #ccc;
    width:1000px;
    margin:0 auto;
    padding:10px 10px;
    background:#fff;
    font-style: italic;
    font-size: 20px;
   	  
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
input[type="submit"].e{
    position:absolute;
    bottom:20%;
    right:45%;
	font-style: italic;
    font-size: 30px;	
}
<?php
session_start();
$user_id=$_SESSION['login_user'];
	if ($user_id !="") 
	{
		include "connect.php";;
	    $s="DELETE FROM user_answer WHERE user_id='".$user_id."'";
		echo $conn->query($s)=== TRUE? "" : "Error: <br>" . $conn->error;
?>
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	localStorage.clear();
	localStorage.setItem("m",0);
	localStorage.setItem("answer","");
	localStorage.setItem("q_id","");
    $('#next').click(function(){
		var c = $('#r_id').val();
        c++ ;
		$('#r_id').val(c);
		localStorage.setItem('mark',0);
		if(c>=1 )
		{
		 
			$("#e").show();
			e.innerText = "QUIZ";
			$("#next").val('next');
			$("#show").hide();	
		 
		}
		if(c==20)
		{
			$("#e").show();
			$("#next").show();
			$("#next").val('next');
			$("#show").hide();	
		}
		if(c==21)
		{
			e.innerText = "you completed the quiz";
			$("#next").hide();	
			$("#show").show();
		}

        data =  {i:c};
		$.post('ajax.php',data,function(data){
			$('#result').html(data);
		});
		
		
    });

});
</script>
<body>
	<p id='d'></p>
    <a href='f.php'><b>Main</b></a>
	<a style='float: right;' href='log_out.php'><b>LOG OUT</b></a><br>
	<h3 id='e'>prss start quiz button below to start:</h3>
	<input type='hidden' id='answer_id' value="8">
	<input type='hidden' id='r_id' value="0">
	<input type="submit" class="e" id="next" value='Start QUIZ'>
	<div id='result'></div>
	<div id='res'></div>
</body>
</html>
<?php
}
	else
	{
		header("Location: log_in.html");
	}
	?>