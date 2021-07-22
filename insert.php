<?php
	include 'database.php';
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$date=$_POST['date'];
	$fait=$_POST['fait'];
	$sql = "INSERT INTO `todo`( `nom`, `description`,`date` , `fait`) 
	VALUES ('$nom','$description','$date','$fait')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
  mysqli_close($conn);
?>
 