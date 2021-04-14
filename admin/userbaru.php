
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
  <?php

if ($_POST['pass'] != $_POST['pass1']) {
// code...
echo "<script type='text/javascript'>
swal('Oopz', 'Password Harus sama..!!', 'error',{

  buttons: {
    confirm: {
      className : 'btn btn-success'
    }
  },
}).then(function(){
      history.go(-1);
  });
</script>";
}elseif($_POST['pass'] == $_POST['pass1']){
include "config/conn.php";
  $id = $_POST['id'];
  $username = $_POST['user'];
  $password = md5($_POST['pass']);
  $name = $_POST['nama'];
  $level = $_POST['level'];

  $query = mysqli_query($conn, "insert into ak value ('$id',
                                                          '$username',
                                                          '$password',
                                                          '$name',
                                                          '$level')");
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
        window.location.href='index.php?halaman=user';
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
    }).then(function(){
        window.location.href='index.php?halaman=user';
      });
  </script>";
  }
}

   ?>
