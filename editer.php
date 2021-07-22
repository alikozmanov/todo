<?php
	include('database.php');
	$nom=$_REQUEST['nom'];
	$description=$_REQUEST['description'];
	$id=$_REQUEST['id'];
	$sql = "SELECT * from todo where id=".$id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ((strcmp($nom, $row['nom']) !== 0) || (strcmp($description, $row['description']) !== 0 )) { 
				$sqlupdate="UPDATE todo SET nom = '".$nom."', description ='".$description."' where id=".$id; 
				$conn->query($sqlupdate);
			}
		}
	}
	mysqli_close($conn);
	echo json_encode(array("statusCode"=>200));
?>