<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php 
$id = $_GET['kode'];
include "config/koneksi_ajax.php";

$modal= $con -> prepare("Delete FROM memo WHERE id='$id'");
	$q = $modal -> execute();
	if ($q) {
	  // code...
	  echo "<script type='text/javascript'>
	  swal('Sukses!', 'Data Berhasil DiHapus..!', 'success',{

	    buttons: {
	      confirm: {
	        className : 'btn btn-success'
	      }
	    },
	  }).then(function(){
	    window.location.href='index.php?halaman=memo';
	  });
	</script>";
	}

?>