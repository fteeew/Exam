<?php
  
	
	  
        include "connect.php";
		$sql = "SELECT * FROM question ORDER BY RAND() LIMIT 1";
		$result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        echo $row['id'];
        

?>