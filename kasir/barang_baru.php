<link rel="stylesheet" media="screen" href="css/jquery.dataTables.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
</style>
<body>
<div class="page-inner">
  <div class="row">
    <div class="col-md-9">
      <div class="card full-height">
        <div class="card-body">
          <div class="card-title">


            <div class="card-sub">

               <div class="card-header card-header-primary">
                  <h4 class="card-title">Transaksi Penambahan Stock</h4>
                  <p class="card-category">Harap selesaikan transaksi anda!</p>
                </div>
            </div>
<div class="row">
            <div class="col-md-12">

          <form role="form" action="index.php?halaman=tambah_baru"  method="post">
          	<input hidden type="text" name="id">


          	<div class="form-group form-group-default">
              <div class="input-group">
               <input placeholder="KODE BARANG" required class="form-control" name="kode" id="kd_brg" autofocus
               data-toggle="modal" data-target=".bd-example-modal-lg">
                <div class="input-group-prepend">
                			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><b>Cari</b> <span class="glyphicon glyphicon-search"></span></button>
                		</div>
              </div>

          	</div>
          	<div style="background-color:#E6E6FA;" class="form-group form-group-default">
          		<input readonly placeholder="Nama Barang" id="nama" type="text" name="nama" class="form-control" >
          	</div>
          	<div style="background-color:#E6E6FA;" class="form-group form-group-default">
               <input readonly id="harga" class="form-control" placeholder="Harga Jual" name="harga" id="harga" >
          	</div>
          	<div class="form-group form-group-default">
               <input placeholder="Jumlah" required oninvalid="this.setCustomValidity('Masukan Jumlah Barang..')" class="form-control" name="jml" id="jml" onFocus="startCalc();" onBlur="stopCalc();">
          	</div>
          	<div class="form-group form-group-default">
          		<input type="submit" class="btn btn-info" name="pos" value="Tambahkan">
          		<input type="reset" class="btn btn-danger" value="Batal">
          	</div>
          </form>

          </div>

          

</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="exampleModalLongTitle">Data Barang</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
				<table  id="example" cellspacing="0" class="display table table-striped table-hover table-head-bg-danger" >
							<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Kode Barang</th>
										<th scope="col">Nama Barang</th>
										<th scope="col">Harga</th>
										<th scope="col">Stok</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								require "config/conn.php";
								$query = mysqli_query($conn, "select * from barang order by kd_brg Asc");
								while ($data = mysqli_fetch_array($query)) {
									// code...

								 ?>
								<tr class="pilih" data-nim="<?php echo $data['kd_brg']; ?>" data-nm="<?php echo $data['nama_brg']; ?>" data-harga="<?php echo $data['harga_jual']; ?>" >
									<td><?php echo $no ?></td>
									<td><?php echo $data['kd_brg'] ?></td>
									<td><?php echo $data['nama_brg'] ?></td>
									<td><?php echo $data['harga_jual'] ?></td>
									<td><?php echo $data['stock'] ?></td>
								</tr>
								<?php
								$no++;
							}
								 ?>
							</table>
						</div>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>

	<script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>
<script type="text/javascript">
//jika dipilih, nim akan masuk ke input dan modal di tutup
         $(document).on('click', '.pilih', function (e) {
             document.getElementById("kd_brg").value = $(this).attr('data-nim');
                 document.getElementById("nama").value = $(this).attr('data-nm');
                     document.getElementById("harga").value = $(this).attr('data-harga');
             $('#exampleModalCenter').modal('hide');
         });


</script>
