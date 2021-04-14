<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
	include "config/koneksi_ajax.php";
	$kode=$_GET['kode'];

	$modal= $con -> prepare("Delete FROM barang WHERE kd_brg='$kode'");
	$q = $modal -> execute();
	if ($q) {
	  // code...
	  echo "<script type='text/javascript'>
	  swal('Sukses!', 'Barang Berhasil DiHapus..!', 'success',{

	    buttons: {
	      confirm: {
	        className : 'btn btn-success'
	      }
	    },
	  }).then(function(){
	    window.location.href='index.php?halaman=barang';
	  });
	</script>";
	}
?>
