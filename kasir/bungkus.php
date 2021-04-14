<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php

include "config/conn.php";
$total1 = $_POST['total'];
$total = "Rp. " . number_format($total1, 0, ',', '.') . "";
$bayar = $_POST['bayar'];
$kembali1 = $_POST['kembali'];
$kembali = "Rp. " . number_format($kembali1, 0, ',', '.') . "";
$_SESSION['tot'] = $total;
$_SESSION['bayar'] = "Rp. " . number_format($bayar, 0, ',', '.') . "";
$_SESSION['kembali'] = $kembali; 

$kode = $_POST['id'];
if ($_POST['bayar'] < $_POST['total']) {
	echo "<script type='text/javascript'>
  swal('Oopzz!', 'Transaksi Gagal., Total Belanja $total', 'error',{

    buttons: {
      confirm: {
        className : 'btn btn-success'
      }
    },
  }).then(function(){
    window.location.href='?halaman=jual';
  });
</script>";
} else {

	$query_insert = "INSERT INTO transaksi (kd_brg,tgl_trans,waktu,jml,diskon,kasir) SELECT barang_keluar.kd_brg,barang_keluar.tgl,barang_keluar.waktu,barang_keluar.jumlah,barang_keluar.diskon, barang_keluar.kasir FROM barang_keluar";

	$insert = mysqli_query($conn, $query_insert);

	echo "<script>
swal('Total Belanja: $total  Kembalian : $kembali', 'Terima Kasih..', {
	buttons: {
		confirm: {
			className : 'btn btn-success'
		}
	},
}).then(function(){
    window.location.href='pos/delete_all.php';
  });
</script>";

}
?>
