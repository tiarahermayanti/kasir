
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
  include "config/conn.php";

  $kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $modal_brg = $_POST['modal'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];

  $query = mysqli_query($conn, "Update barang set nama_brg = '$nama', modal = '$modal_brg', harga_jual = '$harga', stock = '$stok' where kd_brg = '$kode' ");
  if ($query) {
    // code...
    echo "<script type='text/javascript'>
    swal('Ok', 'Update Barang Berhasil..!!', 'success',{

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
    // code...
    echo "<script type='text/javascript'>
    swal('Ok', 'Update Barang Tidak Berhasil..!!', 'error',{

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
