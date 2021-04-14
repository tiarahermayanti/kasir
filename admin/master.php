<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
@session_start();
if (!isset($_SESSION['level']) == "Admin") {
	// code...
	header('location:../');
}

?>
<link rel="stylesheet" media="screen" href="../mastercss/jquery.dataTables.css"/>
<script type="text/javascript" src="../master/js/jquery.js"></script>
<script type="text/javascript" src="../master/js/jquery.dataTables.js"></script>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
</style>
<meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
<meta content="Aguzrybudy" name="author"/>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript" src="../assets/js/core/bootstrap.min.js"></script>
</head>
<body>
  <?php
include "config/conn.php";
?>
  <div class="page-inner mt--4">
  	<div class="row mt--2">
  		<div class="col-md-12">
  			<div class="card full-height">
  				<div class="card-body">
  					<div class="card-title">


  						<div class="card-sub">
              <div style="float:right;" class="">


              <button class="btn btn-primary" data-toggle="modal" data-target="#brgBaru"><span class="btn-label"><i class="fas fa-calendar-plus"></i></span> Tambah Barang</button>

            </div>
  						<div class="card-header card-header-primary">
                  <h4 class="card-title">Data Master Barang</h4>
                  <p class="card-category">Harap selesaikan transaksi!</p>
                </div>
  						</div>

<form class="col-md-7" action="proses_brg.php" name="modal_popup" enctype="multipart/form-data" method="POST">

          <div class="form-group form-group-default">
            <input type="text" name="kode" class="form-control form-control-md" placeholder="Kode Barang" autofocus>
          </div>
          <div class="form-group form-group-default">
              <input required type="text" name="nama" class="form-control form-control-md" placeholder="Nama Barang">
            </div>
            <div class="form-group form-group-default">
              <input required type="text" name="modal" class="form-control form-control-md" placeholder="Modal / pcs">
            </div>
            <div class="form-group form-group-default">
              <input required type="text" name="harga" class="form-control form-control-md" placeholder="Harga Jual / pcs">
            </div>
            <div class="form-group form-group-default">
              <input required type="text" name="stock"  class="form-control form-control-md" placeholder="Stock">
            </div>


      <button type="submit" name="proses" class="btn btn-info" value="Tambahkan">Tambah</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal" name="button">Batal</button>

            </form>
<!-- Modal Popup untuk Add-->
<div class="modal fade" id="brgBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Tambah Barang Baru</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="table-responsive">
      <table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
        <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Kode Barang</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Modal</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Stock</th>
            </tr>
          </thead>
<?php
//menampilkan data mysqli
$no = 0;
$modal = mysqli_query($conn, "select kd_brg, nama_brg, modal, harga_jual, stock from barang");
while ($r = mysqli_fetch_array($modal)) {
	$no++;

	?>
  <tr>
      <td align="center">
        <a href="#" onclick="confirm_modal('delete.php?&kode=<?php echo $r['kd_brg']; ?>');">
          <button class="btn btn-danger btn-border btn-round">
            <span class="btn-label">
                      <i class="fa fa-trash"></i>
                      </span>
            Hapus</button>
        </a>
          <a href="#" class='open_modal' id='<?php echo $r['kd_brg']; ?>'>
            <button class="btn btn-info btn-border btn-round">
              <span class="btn-label">
                        <i class="fas fa-pen"></i>
                        </span>
              Edit</button>
          </a>
      </td>
      <td><?php echo $r['kd_brg']; ?></td>
      <td><?php echo $r['nama_brg']; ?></td>
      <td><?php echo "Rp " . number_format($r['modal'], 2, ',', '.') . ""; ?></td>
      <td><?php echo "Rp " . number_format($r['harga_jual'], 2, ',', '.') . ""; ?></td>
      <td><?php echo $r['stock']; ?></td>
  </tr>


<?php }?>
</table>
</div>
		</div>
	</div>
</div>
<!-- Modal Popup untuk Edit-->
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete-->
<td align="center">
<div style="text-align:center;" class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <h1>Hapus Data..?</h1><br>
  <h1><i style="font-size:150px; color:red;" class="far fa-times-circle"></i> </h1>
  <br>
  <br>
  <a style="color:white;" href="#" class="btn btn-danger" id="delete_link">Yaa.! Hapus data</a>
  <button type="button" class="btn btn-success" data-dismiss="modal">Cancel.!</button>
</div>
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">

      </div>
    </div>
  </div>
</div>
</td>



<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "mod_edit.php",
    			   type: "GET",
    			   data : {kd_brg: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete-->
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

</body>
</html>

<script type="text/javascript">
  $('#Modal').modal('show');
</script>
  <script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>