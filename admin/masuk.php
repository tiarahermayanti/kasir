<?php
include "config/conn.php";
 ?>
 <link rel="stylesheet" media="screen" href="../mastercss/jquery.dataTables.css"/>
<script type="text/javascript" src="../master/js/jquery.js"></script>
<script type="text/javascript" src="../master/js/jquery.dataTables.js"></script>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
</style>
<div class="page-inner mt--4">
	<div class="row mt--2">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">


						<div class="card-header card-header-primary">
                  <h4 class="card-title">Transaksi Penambahan Stock</h4>
                  <p class="card-category">Semua transaksi tercatat disini!</p>
                </div>
          <div class="row">
            <div class="table-responsive">
        				<table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
        					<thead>
        							<tr>
        								<th scope="col"></th>
        								<th scope="col">Kode Barang</th>
        								<th scope="col">Nama Barang</th>
        								<th scope="col">Tanggal</th>
        								<th scope="col">Modal</th>
        								<th scope="col">Harga Penjualan</th>
        								<th scope="col">Qty</th>
        							</tr>
        						</thead>
                    <?php
                    $query = mysqli_query($conn, "SELECT barang.kd_brg, barang.nama_brg, barang_masuk.tgl_masuk, barang.modal, barang.harga_jual, barang_masuk.jumlah FROM barang JOIN barang_masuk on barang.kd_brg=barang_masuk.kd_brg");
                    while ($data = mysqli_fetch_array($query)) {
                      // code...

                     ?>
                    <tr>
                      <td></td>
                      <td><?php echo $data['kd_brg'] ?></td>
                      <td><?php echo $data['nama_brg'] ?></td>
                      <td><?php echo $data['tgl_masuk'] ?></td>
                      <td><?php echo "Rp " . number_format($data['modal'],2,',','.').""; ?></td>
                      <td><?php echo "Rp " . number_format($data['harga_jual'],2,',','.').""; ?></td>
                      <td><?php echo $data['jumlah'] ?></td>
                    </tr>
                  <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  $('#Modal').modal('show');
</script>
  <script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>