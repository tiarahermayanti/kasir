<?php 
$kode = $_GET['kd_brg'];
?>

<link rel="stylesheet" media="screen" href="../mastercss/jquery.dataTables.css"/>
<script type="text/javascript" src="../master/js/jquery.js"></script>
<script type="text/javascript" src="../master/js/jquery.dataTables.js"></script>

<meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
<meta content="Aguzrybudy" name="author"/>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript" src="../assets/js/core/bootstrap.min.js"></script>
</head>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Detail Transaksi <b><?=$kode;?></b></h2>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
<table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
        <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Tanggal & Waktu</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Qty</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <?php 
include "config/conn.php";
$query = mysqli_query($conn, "SELECT barang.kd_brg, transaksi.tgl_trans, transaksi.waktu, barang.nama_brg, barang.harga_jual, transaksi.jml FROM barang JOIN transaksi ON barang.kd_brg=transaksi.kd_brg WHERE barang.kd_brg='$kode' GROUP BY transaksi.kd_trans");
while ($data = mysqli_fetch_array($query)) {
    
          ?>
  <tr>
    <td></td>
    <td><?=$data['tgl_trans']?> <?=$data['waktu'];?></td>
    <td><?=$data['nama_brg']?></td>
    <td><?=$data['harga_jual']?></td>
    <td><?=$data['jml']?></td>
    <td></td>
  </tr>
<?php } ?>
</table>

<a style="float: right;"  href="index.php?halaman=penjualan"><button class="btn btn-danger"> Close</button></a>
</div>
    </div>
  </div>
</div>


  <script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>