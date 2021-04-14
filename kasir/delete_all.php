<?php
require "config/conn.php";


	$query = mysqli_query($conn, "delete from barang_keluar ") or die(mysql_error());
	//$query2 = mysql_query("delete from temp_bayar ") or die(mysql_error());
if ($query) {
  // code...
  echo "<meta http-equiv='refresh' content='0; index.php?halaman=jual'>";
}
 ?>
