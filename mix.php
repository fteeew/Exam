<!DOCTYPE html>
<html>
<body>
<style>
body {
    border: 5px solid #ccc;
     width:500px;
      margin:0 auto;
      padding:10px 25px;
      background:#fff;
      font-style: italic;
       font-size: 20px;	  
}
input
{
	width:40%;
	margin-top:10px;
	border-radius:3px;
	padding:2px;
	box-shadow:0px 1px 1px 0px black;
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
</style>
<body>
<h3 id=headder>edit</h3>
</div>
</body>
 </html>
<?php
	$q = $_GET['id']; 
	include "connect.php";

	$sql = "SELECT question.id,question.text,question.answer_number FROM question where question.id='$q'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
        echo "<input type='hidden' id='id' name='id' value='". $row["id"]."'>";
		echo "<p id='q1'><b> question text:</b></p>";
		echo  "<textarea rows='5' cols='40' id='question_text' value='". $row["text"]."'>". $row["text"]."</textarea>";
		echo "<p id='q2'><b> correct answer:</b></p>";
		echo "<input type='text'  id='correct_answer' value='". $row["answer_number"]."'></input>";
		echo "<p id='q3'><b>answers:</b></p>";
		$sq2="SELECT answer from answer WHERE q_id='".$row["id"]."'";
        $res = $conn->query($sq2);
		$c = 1;
            if ($res->num_rows > 0) 
		    { 
				while($r = $res->fetch_assoc()) 
			    {	
					echo  "<input type='text' name='a_$c' id='a_$c' value=' ". $r["answer"]."'></input><br/>";
					$c =$c+1;
				}	 
			}
		if($c>5)
		{	
			echo "<input type='submit' id='update' onclick='post();'>";
		}
		
		else
		{
			for($t=$c;$t<=5;++$t)
			{
				echo  "<input type='text' name='a_$t' id='a_$t'></input><br/>";	
			}
			echo "<input type='submit' id='update' onclick='post();'>";
		}
		
		$conn->close();

?>
<!DOCTYPE html>
<html>
<body>
<div id="result"></div>
<p id="d"></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
function post()
{

	var i=$('#id').val();	
	var p=$('#question_text').val();
	var p1=$('#correct_answer').val();
	var e1=$('#a_1').val();
	var e2=$('#a_2').val();
	var e3=$('#a_3').val();
	var e4=$('#a_4').val();
	var e5=$('#a_5').val();
	
	var empty_answer=0;
	    if(p==null ||p.trim()=='')
		{ 
			alert("question text is required field please fill it ");
			return false;
		}
	    else if(p1==null ||p1.trim()=='')
	    { 
			alert("correct answer is required field please fill it ");
			return false;
		}
		else if(e1==null ||e1.trim()=='')
		{ 
			alert("answer 1 is required field please fill it ");
			return false;
		}
		else if(e2==null ||e2.trim()=='')
		{ 
			alert("answer 2 is required field please fill it ");
			return false;
		}
		else if (p1 > 5 || p1 < 0) 
	    {
			alert('error should be a number from 1 to 5');
			return false;
	    }
		else if (p1.match(/[a-z]/i))
		{
			alert('error correct answer should not caontain any character'); 
			return false;
		}
		if(e3==null || e3.trim()=='')
		{
			empty_answer=empty_answer+1;
			
		}
		if(e4==null || e4.trim()=='')
		{ 
			empty_answer=empty_answer+1;
			
		}
	    if(e5==null || e5.trim()=='')
		{ 
			empty_answer=empty_answer+1;
		
		}
		var inserted_answer=5-empty_answer;
		if(p1>inserted_answer)
		{
			alert('the correct answer is invalid ');
			return false;
		}
		
		
			if (e1.trim() == e2.trim())
			{
				alert('error two answers are equal'); 
				return false;
				
			}
			if(e3!=null ||e3.trim()!='')
			{
				if (e2.trim() == e3.trim()||e1.trim() == e3.trim())
				{
					alert('error two answers are equal'); 
					return false;
						
				}
				if(e4!='')
				{
					if (e3.trim() == e4.trim())
					{
						alert('error two answers are equal');
                        return false;						
					
					}
				}
				if(e5!='')
				{
					if (e3.trim() == e5.trim())
					{
						alert('error two answers are equal'); 
						return false;
					
					}
				}
			}
			if(e4!=null ||e4.trim()!='')
			{
				if (e2.trim() == e4.trim()||e1.trim() == e4.trim())
				{
					alert('error two answers are equal'); 
					return false;
					
				}
				if(e5!='')
				{
					if (e4.trim() == e5.trim())
					{
						alert('error two answers are equal'); 
						return false;
					
					}	
				}
			}
			if(e5!=null ||e5.trim()!='')
			{
				if (e1.trim() == e5.trim()||e2.trim() == e5.trim())
				{
					alert('error two answers are equal');
					return false;					
				}
			}
	$('#headder').hide();
    $('#update').hide();
    $('#q1').hide();
	$('#q2').hide();
	$('#q3').hide();
	$('#id').hide();
	$('#question_text').hide();
	$('#correct_answer').hide();
	$('#a_1').hide();
	$('#a_2').hide();
	$('#a_3').hide();
	$('#a_4').hide();
	$('#a_5').hide();	
	$.post('insert.php',{id:i,question_text:p,correct_answer:p1,a_1:e1,a_2:e2,a_3:e3,a_4:e4,a_5:e5}
	,function(data){
	$('#result').html(data);
	});
	
	
 
}
</script>
</body>
</html>