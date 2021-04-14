<?php

if(isset($_POST["id"])){

 $connect = new PDO('mysql:host=localhost;dbname=parfum', 'root', '');

 $query = "DELETE from shelli_events WHERE id=:id";

 $statement = $connect->prepare($query);

 $statement->execute(

  array(

   ':id' => $_POST['id']

  )

 );

}

?>