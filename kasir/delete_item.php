

<html>
<head>
<title>MENGHAPUS DATA ANGSURAN KREDIT ... </title>
<META http-equiv="refresh" content="0;URL=./?halaman=jual">
</head>
<body>

<?php
require "config/conn.php";
$id = $_GET['id'];

$back = mysqli_query($conn, "select DISTINCT barang_keluar.kd_brg, sum(jumlah) AS jml FROM barang_keluar where barang_keluar.kd_brg = '$id' ");
while ($data = mysqli_fetch_array($back)) {
	// code...
	$kode = $data['kd_brg'];
	$jml = $data['jml'];
}
$cek = mysqli_query($conn, "select * from barang where kd_brg = '$id'");
while ($up = mysqli_fetch_array($cek)) {
	// code...
	$qty = $up['stock'];
}
$baru = $jml + $qty;

	$update = mysqli_query($conn, "update barang set stock = '$baru' where kd_brg = '$id'");
$query = mysqli_query($conn, "delete from barang_keluar where kd_brg='$id'");

if ($query) {
}
?>
</body>
</html>
