
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
  <?php

if (@$_POST['proses']) {
// code...
include "config/conn.php";
  $kd_brg = $_POST['kode'];
  $nama_brg = $_POST['nama'];
  $modal = $_POST['modal'];
  $harga_jual = $_POST['harga'];
  $stock = $_POST['stock'];

  $query = mysqli_query($conn, "insert into barang value ('$kd_brg',
                                                          '$nama_brg',
                                                          '$modal',
                                                          '$harga_jual',
                                                          '$stock')");
  if ($query) {
    // code...
    echo "<script type='text/javascript'>
    swal('Ok', 'Penambahan Barang Berhasil..!!', 'success',{

      buttons: {
        confirm: {
          className : 'btn btn-success'
        }
      },
    }).then(function(){
        window.location.href='index.php?halaman=barang';
      });
  </script>";
  }else {
    echo "<script type='text/javascript'>
    swal('Oopz', 'Penambahan Barang Gagal..!!', 'error',{

      buttons: {
        confirm: {
          className : 'btn btn-success'
        }
      },
    });
  </script>";
  }
}

   ?>
