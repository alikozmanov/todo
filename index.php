<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>todo</title>
</head>

<body>


  <header>
  
  
    <ul>
        <li class="logo"><a href="TODO">TODO</a></li>
        <li><a href="mentionslegales.php">Mentions Légales</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>



  </header>
  
  <table>
     <tr> 
        <th>id</th>
        <th>nom</th>
        <th>description</th>
        <th>date</th>
        <th>fait</th>
        <th>action 1</th>
        <th>action 2</th>
     </tr>
<?php
$servername = "localhost";
$username = "ogue";
$password = "oguz";
$dbname = "bddtodo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM todo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<form id=\"updateForm\" name=\"form2\" method=\"post\">";
    echo "<tr>";
    echo "<td id=\"id\">". $row["id"]."</td>";
    echo "<td id=\"nom".$row["id"]."\" contenteditable>". $row["nom"]."</td>";
    echo "<td id=\"description".$row["id"]."\" contenteditable>". $row["description"]."</td>";
    echo "<td id=\"date".$row["id"]."\">". $row["date"]."</td>";
    echo "<td id=\"fait".$row["id"]."\">". $row["fait"]."</td>";  
    echo "<td><button onclick=deleteData(". $row["id"].")>supprimer</button></td>";
    echo "<td><button onclick=updateData(".$row["id"].")>editer</button></td>";
    echo "</tr>";
    echo "</form>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>

<form id="fupForm" name="form1" method="post">
  	<tr>
    	<td>ajouter une tache</td>
		<td class="form-group">
			<input type="text" class="form-control" id="nom" placeholder="Nom" name="nom">
		</td>
		<td class="form-group">
			<input type="textarea" class="form-control" id="description" placeholder="description" name="description">
		</td>
		<td class="form-group">
			<input type="date" class="form-control" id="date"  name="date">
		</td>
		<td class="form-group" >
			<select name= "fait" id="fait">
			<option value="0">non</option>
			<option value="1">oui</option>
			</select>
		</td>
		<td><input type="button" name="save" class="btn btn-primary" value="ajouter" id="butsave"></td>
    </tr>
</form>

  </table>
<div id="msg"></div>
<div id="table-container"></div>
<script>
// Insert
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var nom = $('#nom').val();
		var description = $('#description').val();
		var date = $('#date').val();
		var fait = $('#fait').val();
		if(nom!="" && description!="" && date!="" && fait!=""){
			$.ajax({
				url: "insert.php",
				type: "POST",
				data: {
					nom: nom,
					description: description,
					date: date,
					fait: fait				
				},
				cache: false,
				success: function(dataResult){
					console.log(dataResult);
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 	
 
            location.reload();			
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
     
});
// Update
function updateData(id) {
	var nom = $('#nom'+id).html();
	var description = $('#description'+id).html();
	if(nom!="" && description!="") {
		$.ajax({
			url: "editer.php",
			type: "POST",
			data: { 
				id: id,
				nom: nom,
				description: description	
			},
			cache: false,
			success: function(data){
				console.log(data);
				location.reload(true);
			}
		});
	} else {
		alert('Please fill all the field !');
	}
}

function deleteData(id) {

$.ajax({    
    type: "GET",
    url: "delete.php", 
    data:{deleteId:id},            
    dataType: "html",                  
    success: function(data){   

    $('#msg').html(data);
   $('#table-container').load('fetch-data.php');
       
    }

});
location.reload();
}

</script>

	<footer>réalisé par alik ozmanov 12 juillet 2021</footer>

 </body>
</html>