<?php

require "config/conn.php";

$query = mysqli_query($conn, "SELECT * FROM barang WHERE kd_brg='".mysqli_escape_string($conn, $_POST['kd_brg'])."'");
$data = mysqli_fetch_array($query);

echo json_encode($data);

?>
