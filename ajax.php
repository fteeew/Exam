
<?php
    if (isset($_POST['i']))
	{
	session_start();
	$user_id=$_SESSION['login_user'];
	echo "<input type='hidden' id='u_id' name='u_id' value='".$user_id."'>";
	display($_POST['i']);  
    }
?>

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
input[type="submit"]{
    position:absolute;
    bottom:30%;
    right:50%;
	font-style: italic;
    font-size: 25px;	
}
</style>
<body>
	<div id='result'></div>
	<div id='res'></div>
	<input type='hidden' id='a_id' value="0">
	<p id='demo' align='center' ></p>
	<p id='d'></p>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			var user_id=$('#u_id').val();
			var mark=0;
			$('#myForm input').on('change', function() {
				var check_value= $('input[name=qq]:checked', '#myForm').val(); 
				var question_number=$('#id').val();
				var ans_num=$('#a_id').val();
				var user_id=$('#u_id').val();
				if(check_value==ans_num)
				{
					mark=mark+1;
					var c= parseInt(localStorage.getItem("m")|| 0);
					localStorage.setItem("m", c + 1);
				
				}
				else {

					var c= parseInt(localStorage.getItem("m")|| 0);
					localStorage.setItem("m",c + 0);
				
				}
			var n=$('#number').val();
			var t=$('#text').val();
			var a1=$('#an_1').val();
			var a2=$('#an_2').val();
			var a3=$('#an_3').val();
			var a4=$('#an_4').val();
			var a5=$('#an_5').val();
			var t1=$('#a_1').val();
			var t2=$('#a_2').val();
			var t3=$('#a_3').val();
			var t4=$('#a_4').val();
			var t5=$('#a_5').val();
            data={q_number:question_number,user_answer_number:check_value,u_id : user_id ,number:n,text:t,a1:a1,a2:a2,a3:a3,a4:a4,a5:a5,a_1:t1,a_2:t2,a_3:t3,a_4:t4,a_5:t5};
            $.post('insert_user.php',data,function(data){
				$('#result').html(data);
				
			});
	
		});	
		

		$('#show').click(function(){
			   
			var q_i=localStorage.getItem("q_id");
			var m=localStorage.getItem("m");
			data =  {i:q_i,mark:m,u_id:user_id};
			$.post('show_answer.php',data,function(data){
				$('#result').html(data);
			});
		});	
		
});


</script>
</body>
</html>

<?php


function display($i)
	{
		if($i<=20)
		{  
			echo  "<p align='center'>Question " .$i." from 20 Questions</p><br><br>";
	         include "connect.php";
			$sql = "SELECT * FROM question where id not in(select question_number from user_answer) order by rand()" ;
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$answer=$row["answer_number"];
			echo "<input type='hidden' id='id' name='id' value='". $row["id"]."'>";
			echo "<input type='hidden' id='text' name='text' value='". $row["text"]."'>";
			echo "<input type='hidden' id='number' name='number' value='". $i."'>";
			echo "<script type='text/javascript'>
			var c=$('#id').val();
			var a=localStorage.getItem('q_id')+c+',';
			localStorage.setItem('q_id',a);
			</script>";
			//echo $answer;
			include "conn.php";
	        $sq1 =$conn->prepare("INSERT INTO user_answer(user_id,question_number,answer_number)VALUES (:i,:q,'')");
	        $sq1->bindParam(':i',$user_id,PDO::PARAM_INT);
	        $sq1->bindParam(':q',$row["id"],PDO::PARAM_INT);
	        $sq1->execute();
			echo  "" .$i. ": " . $row["text"]. "<br><br>";
			echo "<input type='hidden' id='a_id' value='". $answer."'>";
			$s= mysqli_query($conn,"SELECT answer,answer_id from answer WHERE q_id='".$row['id']."'order by answer") or die("Failed");
			$c=1; 
			echo "<form id='myForm'>";
			while($result = mysqli_fetch_array($s))
			{
			    
				echo "</br>";
				echo "<input type='radio' name='qq' value='".$result["answer_id"]."'>". $result["answer"]."</input><br/>";	
				echo "<input type='hidden' name='an_$c' id='an_$c' value='".$result["answer"]."'>";
				echo "<input type='hidden' name='a_$c' id='a_$c' value='".$result["answer_id"]."'>";
				$c += 1;
				
			}
	
			echo "</form>";
			
	
				
			
			
		}
		
		else
			
		{
			echo "<p align=center>your grade from 20 is:<br></p>";
			echo "<script type='text/javascript'>$('#demo').text(localStorage.getItem('m'));</script>";
			echo "<input type='submit' id='show' onclick='post()' value='show answers'>";
			
		}
		
	} 

?>


    