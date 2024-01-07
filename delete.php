<?php
if(isset($_GET['id'])){

    $id =$_GET['id'];

$servername = "localhost";
$username = "root";
$password ="";
$database ="application";


             //creating my connection
$connection = new mysqli($servername, $username, $password, $database); 


$sql = "DELETE  FROM clientsss WHERE id=$id";
$connection->query($sql);
}

header("location: /crud_application/index.php");
exit;
?>