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
	$id=$_GET['id'];

	$modal= $con -> prepare("Delete FROM ak WHERE id='$id'");
	$q = $modal -> execute();
	if ($q) {
	  // code...
	  echo "<script type='text/javascript'>
	  swal('Sukses!', 'User Berhasil DiHapus..!', 'success',{

	    buttons: {
	      confirm: {
	        className : 'btn btn-success'
	      }
	    },
	  }).then(function(){
	    window.location.href='index.php?halaman=user';
	  });
	</script>";
	}
?>
