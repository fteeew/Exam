<?php
	
if (isset($_POST['i'])&& isset($_POST['mark'])&& isset($_POST['u_id']))
{

	$id=substr( $_POST['i'], 0, -1);
	$id=explode(",",$id);
	echo "<p align='center' style='color:red;'> your mark in the quiz is: ".$_POST['mark']." from 20<br></p>";
	//print_r($id);
	$arrlength = count($id);
	$i=1;
    for($x = 0; $x < $arrlength; $x++)	
	{
		include "connect.php";
		$sql = "SELECT question.text,question.answer_number FROM question where id='".$id[$x]."'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		echo  "<br>" .$i. ": " . $row["text"]. "<br><br>";
		$i=$i+1;
		//to know the user answer
		$sq2 = "SELECT answer_number FROM user_answer WHERE user_id='".$_POST['u_id']."' and question_number='".$id[$x]."'";
		$r = mysqli_query($conn,$sq2);
		$res= mysqli_fetch_array($r,MYSQLI_ASSOC);
		//echo $res['answer_number'];
		//to display answer
		$s= mysqli_query($conn,"SELECT answer,answer_id from answer WHERE q_id='".$id[$x]."'order by answer") or die("Failed");
	        
			while($result = mysqli_fetch_array($s))
			{
			    
				echo "</br>";
				$n=$result["answer_id"];
                if($n==$res['answer_number'])
				{
					echo "<input type='radio' value='".$result["answer"]."'CHECKED/>". $result["answer"]."</input><br/>";
                    					
				}
				else
				{
					echo "<input type='radio'  value='".$result["answer"]."'>". $result["answer"]."</input><br/>";
				}
				
			}

		// to echo the corresct answer
		$sq3 = "SELECT answer FROM answer where q_id='".$id[$x]."' and answer_id='".$row['answer_number']."'";
		$p= mysqli_query($conn,$sq3);
		$z = mysqli_fetch_array($p,MYSQLI_ASSOC);
		echo "<p style='color:red;'> the correct answer is:".$z['answer']." </p>";
       
	    echo "_____________________________________________<br>";
	}
}
?>
