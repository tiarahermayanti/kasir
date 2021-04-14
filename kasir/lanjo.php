<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
if (isset($_POST['pos'])) {
  
    // code...
    require "config/conn.php";
    $id = $_POST['id'];
    $waktu = $_POST['waktu'];
    $jam = $_POST['jam'];
    @$jenis = $_POST['jenis'];
    @$total = $_POST['total'];

    $sql = mysqli_query($conn, "insert into pengeluaran value('$id',
                                                              '$waktu',
                                                              '$jam',
                                                              '$jenis',
                                                              '$total')");
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
        window.location.href='?halaman=pengeluaran';
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
      window.location.href='?halaman=pengeluaran';
    });
</script>";
    }
  }

?>
