
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
  <?php

if (@$_POST['pos']) {
// code...
include "config/conn.php";
  $id = $_POST['id'];
  $tanggal = $_POST['tgl'];
  $memo = $_POST['memo'];
  $status = $_POST['status'];

  $query = mysqli_query($conn, "insert into memo value ('$id',
                                                          '$tanggal',
                                                          '$memo',
                                                          '$status')");
  if ($query) {
    // code...
    echo "<script type='text/javascript'>
    swal('Ok', 'Penambahan Memo Baru Berhasil..!!', 'success',{

      buttons: {
        confirm: {
          className : 'btn btn-success'
        }
      },
    }).then(function(){
        window.location.href='index.php?halaman=memo';
      });
  </script>";
  }else {
    echo "<script type='text/javascript'>
    swal('Oopz', 'Penambahan Memo Baru Gagal..!!', 'error',{

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
}

   ?>
