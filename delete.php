<?php

include('database.php');

if(isset($_GET['deleteId'])){

    $id= $_GET['deleteId'];
    delete_data($conn, $id);

}

// delete data query
function delete_data($conn, $id){
   
    $query="DELETE from todo WHERE id=$id";
    $exec= mysqli_query($conn,$query);

    if($exec){
      echo "Data was deleted successfully";
    }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
      echo $msg;
    }
}
?>