<?php
	include 'database.php';
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$id=$_POST['id'];
	$sql = "SELECT * from todo where id=".$id;
	if ($result=mysqli_query($conn, $sql)) {
		$row = mysql_fetch_array($result);
		$nombdd = $row['nom'];
		$descriptionbdd = $row['description'];
		if (strcmp($nom, $nombdd) !== 0 || strcmp($description, $descriptionbdd) !== 0 ) { 
			
			$sqlupdate="UPDATE todo SET nom = '".$nom."', description ='".$description."' where id=".$id; 
			mysqli_query($conn,$sqlupdate);
		}
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
  mysqli_close($conn);


  
?>

 