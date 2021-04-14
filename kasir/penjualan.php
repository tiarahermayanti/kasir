<html>
<?php 
$conn=mysqli_connect("localhost", "root", "", "parfum");
date_default_timezone_set('Asia/Jakarta');
?>
<script type="text/javascript">
function startCalc(){
interval = setInterval("calc()",1);}
function calc(){

two = document.autoSumForm.bayar.value;
total = document.autoSumForm.total.value;

	document.autoSumForm.kembali.value = two - total ;
}
function stopCalc(){
clearInterval(interval);}
</script>
<body>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<?php

if (isset($_POST['pos'])) {

	if ($_POST['nama'] == '') {
		# code...
		echo "<script>
 			swal('Oopzz!', 'Barang Belum terdaftar.. Harap periksa kembali..!', {
 				icon : 'error',
 				buttons: {
 					confirm: {
 						className : 'btn btn-danger'
 					}
 				},
 			});
 			</script>";
	} else {

		include "config/conn.php";

		$id_keluar = @$_POST['id'];
		$kd_brg = @$_POST['kode'];
		$nm_brg = @$_POST['nama'];
		$harga_jual = @$_POST['harga'];
		$tgl = date("Y-m-d");
		$waktu = date("H:i:s");
		$jumlah = $_POST['jml'];
		$diskon = $_POST['diskon'];
		$total_harga = $harga_jual * $jumlah;
		@$sub = $total_harga - ($total_harga * $diskon) / 100;
		$kasir = $_SESSION['username'];

		$sqlku = "SELECT stock from barang where kd_brg='$kd_brg'";
		$queryku = mysqli_query($conn, $sqlku);
		$dataku = mysqli_fetch_array($queryku);

		if ($dataku['stock'] < $jumlah) {
			echo "<script>
 			swal('Oopzz!', 'Transaksi Gagal..! Stock barang tidak cukup..! ', {
 				icon : 'error',
 				buttons: {
 					confirm: {
 						className : 'btn btn-danger'
 					}
 				},
 			});
 			</script>";
		} else {

			$query_insert = "insert into barang_keluar value('$id_keluar',
															'$kd_brg',
															'$nm_brg',
															'$harga_jual',
															'$tgl',
															'$waktu',
															'$jumlah',
															'$diskon',
															'$sub',
															'$kasir')";

			$insert = mysqli_query($conn, $query_insert);

			if ($insert) {
			} else {
				echo "<p>GAGAL DITAMBAHKAN</p>";
			}

		}
	}

}

?>
<?php
$select1 = "SELECT SUM(total_harga) AS total FROM barang_keluar";
$select_query1 = mysqli_query($conn, $select1);
while ($dataku = mysqli_fetch_array($select_query1)) {

	$total = $dataku['total'];
}
?>
<style type="text/css">
	.page-inner{
		margin-top: -50px;
	}
</style>
<div class="page-inner">
	<div class="row mt--4">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">


						<div class="card-sub">

							 <div class="card-header card-header-primary">
                  <h4 class="card-title">Transaksi Penjualan</h4>
                  <p class="card-category">Harap selesaikan transaksi anda!</p>
                </div>
						</div>
<div class="row">

	<div class="col-md-5">
		<div class="card">

<form style="padding:10px;" role="form" action=""  method="post">
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
	<div readonly class="form-group form-group-default">
		<input readonly id="nama" type="text" name="nama" class="form-control" placeholder="Nama Barang">
	</div>
	<div class="form-group form-group-default">
     <input placeholder="Jumlah" required type="text" class="form-control" name="jml" id="jml" onFocus="startCalc();" onBlur="stopCalc();">
	</div>
	<div class="form-group form-group-default">
		 <input class="form-control" id="diskon" name="diskon" placeholder="Diskon">
</div>
	<div hidden style="background-color:#E6E6FA;" class="form-group form-group-default">
     <input readonly id="harga" class="form-control" placeholder="Harga Jual" name="harga" id="harga" >
	</div>
	<div class="form-group form-group-default">
		<input type="submit" class="btn btn-info" name="pos" value="Tambahkan">
		<input type="reset" class="btn btn-danger" value="Batal">
	</div>
</form>
</div>
</div>
<script src="jsku.js"></script>
	<script>
		$(function() {
			$("#kd_brg").change(function(){
				var kd_brg = $("#kd_brg").val();

				$.ajax({
					url: 'proses.php',
					type: 'POST',
					dataType: 'json',
					data: {
						'kd_brg': kd_brg
					},
					success: function (parfum) {
						$("#nama").val(parfum['nama_brg']);
						$("#harga").val(parfum['harga_jual']);

					}
				});
			});


		});
	</script>

<div class="col-lg-4">
<div class="card">

<form style="padding:10px;" role="form" name="autoSumForm" action="?halaman=proses"  method="post">

<input hidden type="text" name="id" value="">
<div class="form-group form-group-default">
		<label>*Total Belanja</label>
     <input readonly class="form-control" name="total" id="total" value="<?php echo "$total"; ?>" onFocus="startCalc();" onBlur="stopCalc();">
	</div>
<div class="form-group form-group-default">
		<label>*Pembayaran</label>
     <input required oninvalid="this.setCustomValidity('Masukan Jumlah Pembayaran..')" type="text" class="form-control" name="bayar" id="bayar" onFocus="startCalc();" onBlur="stopCalc();">
	</div>
	<div class="form-group form-group-default">
		<label>*kembalian</label>
     <input readonly class="form-control" name="kembali" id="kembali" onchange='tryNumberFormat(this.form.thirdBox);'>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-secondary btn-lg btn-block" id="proses" name="simpan" >PROSES</button>
	</div>
	</form>

	</div>
	</div>
	<div class="col-lg-3">
		<div style="padding:2px;">


		<?php
$select1 = "SELECT SUM(total_harga) AS total FROM barang_keluar";
$select_query1 = mysqli_query($conn, $select1);
while ($dataku = mysqli_fetch_array($select_query1)) {

	$total = $dataku['total'];
}
?>

			<div style="border-radius: 10px; background-color: red;font-family:fantasy; color:white;"><h1 style="margin-left: 5px;font-size: 40px;font-family:fantasy; color:white;">Total : <?php echo "Rp." . number_format($total, 2, ",", ".") . ""; ?></h1></div>
<hr>
<br>
<li style="font-size:12px;">Home Kode Barang</li>
<li style="font-size:12px;">F2 Diskon</li>
<li style="font-size:12px;">End Jumlah </li>
<li style="font-size:12px;">F4 Pembayaran</li>
<!--		<div style="background-color:#E6E6FA;" class="card">
			<h2 align="center">Struk Pembelian</h2>
			<div style="margin:0 auto;" class="avatar avatar-xl">
			<img style="margin:auto; display:block;"  alt='...' class='avatar-img rounded-circle' src="../img/logo.jpeg" alt="">
		</div>-->
		</div>
	</div>
</div>
		<div class="table-responsive">
				<table id="basic-datatables" class="display table table-striped table-hover table-head-bg-danger" >
					<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">Nama Barang</th>
								<th scope="col">Harga</th>
								<th scope="col">Diskon</th>
								<th scope="col">Qty</th>
								<th scope="col">Total Harga</th>
							</tr>
						</thead>
						<?php
require "config/conn.php";
$query = mysqli_query($conn, "select DISTINCT id_keluar, barang_keluar.kd_brg, nm_brg, barang_keluar.harga_jual, diskon, sum(jumlah) AS jml, sum(total_harga) AS sub FROM barang_keluar join barang WHERE barang_keluar.kd_brg=barang.kd_brg GROUP by kd_brg");
while ($data = mysqli_fetch_array($query)) {
	// code...
	?>
						<tbody>
		<td align="center"> <a href="delete_item.php?id=<?php echo "$data[kd_brg]"; ?>">
								<button type="button" class="btn btn-icon btn-round btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus data.!">
									<i class="material-icons">restore_from_trash</i>
								</button>
							</a> </td>
							<td><?php echo $data['nm_brg'] ?></td>
							<td><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
						<?php
if ($data['diskon'] == '') {
		# code...
		$diskon = 0;
	} else {
		$diskon = $data['diskon'];
	}
	?>
							<td><?php echo "$diskon %"; ?></td>
							<td><?php echo $data['jml'] ?></td>
							<td><?php echo "Rp " . number_format($data['sub'], 2, ',', '.') . ""; ?></td>
						</tbody>
					<?php }?>
					</table>
				</div>
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
<script src="jsku.js"></script>
	<script>
		$(function() {
			$("#kd_brg").change(function(){
				var kd_brg = $("#kd_brg").val();

				$.ajax({
					url: 'proses.php',
					type: 'POST',
					dataType: 'json',
					data: {
						'kd_brg': kd_brg
					},
					success: function (parfum) {
						$("#nama").val(parfum['nama_brg']);
						$("#harga").val(parfum['harga_jual']);

					}
				});
			});
		});
	</script>
<script type="text/javascript">
      document.onkeydown = function (e){
        switch (e.keyCode) {
          case 36: //home
            document.getElementById("kd_brg").focus();
            break;
            case 113://f2
              document.getElementById("diskon").focus();
              break;
	            case 35://end
	              document.getElementById("jml").focus();
	              break;
		            case 115://f4
		              document.getElementById("bayar").focus();
		              break;
			            case 116: //f6
			              document.getElementById("proses").focus();
			              break;
      }
    };
    </script>
