<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
if (isset($_POST['pos'])) {
	if ($_POST['nama'] == '') {
		echo "<script type='text/javascript'>
  swal('Oopzz', 'Barang Tidak diTemukan..', 'error',{

    buttons: {
      confirm: {
        className : 'btn btn-success'
      }
    },
  }).then(function(){
      window.location.href='?halaman=beli';
    });
</script>";
	} else {
		// code...
		require "config/conn.php";
		date_default_timezone_set('Asia/Jakarta');
		$kd_masuk = $_POST['id'];
		@$kd_brg = $_POST['kode'];
		@$tgl_masuk = date('d-m-Y');
		@$jumlah = $_POST['jml'];

		$sql = mysqli_query($conn, "insert into barang_masuk value('$kd_masuk',
                                                              '$kd_brg',
                                                              '$tgl_masuk',
                                                              '$jumlah')");
		if ($sql) {
			// code...
			echo "<script type='text/javascript'>
    swal('Oookk', 'Stock Berhasil di Tambahkan', 'success',{

      buttons: {
        confirm: {
          className : 'btn btn-success'
        }
      },
    }).then(function(){
        window.location.href='?halaman=beli';
      });
  </script>";
		} else {
			echo "<script type='text/javascript'>
  swal('Oopzz', 'Stock Gagal di Tambahkan', 'error',{

    buttons: {
      confirm: {
        className : 'btn btn-success'
      }
    },
  }).then(function(){
      window.location.href='?halaman=beli';
    });
</script>";
		}
	}
}
?>
