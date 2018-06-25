<html>
<style>
body {
    border: 5px solid #ccc;
     width:700px;
      margin:0 auto;
      padding:10px 10px;
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
    font-size: 40px;	
}
input[type="submit"].e{
    position:absolute;
    bottom:30%;
    right:40%;
	font-size:40 px;	
}

</style>
<body>
<h3> Quiz</h3>
<?php
    function display($question_number)
	{
		
	    echo "<div id='q'>";
		include "connect.php";
		$sql = "SELECT question.text,question.answer_number FROM question where id='$question_number' ";
		$r = $conn->query($sql);
		$row = $r->fetch_assoc();
		echo  "" .$question_number. ": " . $row["text"]. "<br><br>";
		$answer=$row["answer_number"];
		echo "<input type='hidden' id='answer_id' value='". $answer."'>";
		$s= mysqli_query($conn,"SELECT answer,answer_id from answer WHERE q_id='".$question_number."'order by answer") or die("Failed");
	    $c=1; 
		
			while($result = mysqli_fetch_array($s))
			{
			    
				echo "</br>";
				echo "<input type='radio' name='qq' value='".$result["answer_id"]."' id='a_$c'>". $result["answer"]."</input><br/>";	
				$c += 1;
				
			}
		$question_number=$question_number+1;
		 echo "<input type='submit' value='Next' onclick='post();'>";
		 echo "</div>";
	} 
	
  echo  display($question_number=10);
?>
<p id='demo'></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	
	
	$("#submit").click(function(){
		var mark=0;
		var ans_num=$('#answer_id').val();
		var check_value=$('input[name=qq]:checked').val();
		if(check_value==ans_num)
		{
			mark=mark+1;
		}
		alert(mark);
		//document.getElementById("demo").innerHTML =mark ;
		$('#q').hide();
	});
	
</script>
</body>
</html>

    
    
