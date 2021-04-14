<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
include "config/koneksi_ajax.php";

$id = $_POST['kode'];
$query=$con->prepare("update memo set status = '1' where id = '$id'");
$q=$query->execute();

if ($q){
  echo "<script type='text/javascript'>
  swal('Sukses!', 'Telah dilakukan..!', 'success',{

    buttons: {
      confirm: {
        className : 'btn btn-success'
      }
    },
  }).then(function(){
    window.location.href='./';
  });
</script>";

}
else
{
  alert('gagal');
}
?>
