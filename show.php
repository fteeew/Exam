<html>
<style>
body {
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
    font-size: 40px;	
}


</style>
<body>
<h3> Questions</h3>
<p > Note: the correct answer has the sign **</p>
</div>
</body>
</html>
<?php
    $n=0;
    include "connect.php";
	$sql = "SELECT question.id,question.text,question.answer_number FROM question ";
	$r = $conn->query($sql);
	$i=1;
    $n=1;
	if ($r->num_rows > 0 ) 
    {
			// output data of each row
		while($row = $r->fetch_assoc()) 
		{
			echo  "" .$i. ": " . $row["text"]. "<br><br>";
			$answer=$row["answer_number"];
			
			
			$s= mysqli_query($conn,"SELECT answer,answer_id from answer WHERE q_id='".$row["id"]."'order by answer") or die("Failed");
	        
			while($result = mysqli_fetch_array($s))
			{
			    
				echo "</br>";
				$n=$result["answer_id"];
                if($n==$answer)
				{
					echo "<input type='radio' value='".$result["answer"]."'>". $result["answer"]."**</input><br/>";	
				}
				else
				{
					echo "<input type='radio'  value='".$result["answer"]."'>". $result["answer"]."</input><br/>";
				}
				
			}
			$i=$i+1;
            echo "<br>";
			echo "<button type=submit onclick=location.href='delete.php?id=" . $row["id"]."' id=delete >delete</button>";
			echo "<button type=submit onclick=location.href='mix.php?id=" . $row["id"]."' id=update >update</button>";
		    echo "<br>-------------------------------------------------<br>";		
		}
	
	
	}	
?>
    
    
