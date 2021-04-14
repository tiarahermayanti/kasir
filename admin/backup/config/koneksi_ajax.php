<?php
@session_start();
if (!isset($_SESSION['level']) == "Admin") {
  // code...
    header('location:../');
}

//Koneksi Sederhana menggunakan PDO
$con=new PDO("mysql:host=localhost;dbname=parfum","root","");
?>
