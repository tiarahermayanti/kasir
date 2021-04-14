<?php
@session_start();
if (!isset($_SESSION['level']) == "Admin") {
  // code...
    header('location:../');
}


$conn = mysqli_connect("localhost", "root", "", "parfum");

 ?>
