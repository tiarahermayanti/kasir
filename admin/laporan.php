<link rel="stylesheet" media="screen" href="../mastercss/jquery.dataTables.css"/>
<script type="text/javascript" src="../master/js/jquery.js"></script>
<script type="text/javascript" src="../master/js/jquery.dataTables.js"></script>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
</style>
<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">


						<div class="card-sub">
              
<div class="card-header card-header-primary">
  <button style="float:right;" class="btn btn-danger" type="button" name="button" data-toggle="modal" data-target="#Modal">
                 <i class="material-icons">library_books</i>
                Rekapitulasi</button>
                  <h4 class="card-title">Laporan Penjualan</h4>
                  <p class="card-category">Semua transaksi tercatat disini, Laporan per Hari, Minggu, Tahun, dll.!</p>
                </div>

						</div>
          </div>
          <script type="text/javascript" src="../assets/date/jquery.min.js"></script>
          <script type="text/javascript" src="../assets/date/moment.min.js"></script>
          <script type="text/javascript" src="../assets/date/daterangepicker.min.js"></script>
          <link rel="stylesheet" type="text/css" href="../assets/date/daterangepicker.css" />





          <div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">

                 <div class="modal-header">
                   <h2 class="modal-title" id="myModalLabel">Rekapitulasi Transaksi</h2>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   </div>

                   <div class="modal-body">

                     <form class="" action="" method="post">
                       <div class="form-group form-group-default">
                         <label>Pilih Tanggal Rekap</label>
                         <b><input id="reportrange" type="text" name="rekap" class="form-control" placeholder="Fill Name"></b>
                       </div>


                         <div class="modal-footer">
                             <input class="btn btn-info" type="submit" name="go" value="Tampilkan">
                         </form>
                         </div>


                       </div>


                   </div>
               </div>
          </div>
<?php

if (!isset($_POST['go'])) {
	// code...

	?>

 <div class="table-responsive">
   <table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
     <thead>
     <tr>
       <th style="text-align:center;" scope="col">No</th>
       <th style="text-align:center;" scope="col">Tanggal</th>
       <th style="text-align:center;" scope="col">Jam</th>
       <th style="text-align:center;" scope="col">Kasir</th>
       <th style="text-align:center;" scope="col">Nama Barang</th>
       <th style="text-align:center;" scope="col">Modal</th>
       <th style="text-align:center;" scope="col">Harga Jual</th>
       <th style="text-align:center;" scope="col">Qty</th>
       <th style="text-align:center;" scope="col">Diskon</th>
       <th style="text-align:center;" scope="col">Total</th>
       <th style="text-align:center;" scope="col">Keuntungan</th>
     </tr>
   </thead>
   <?php
include "config/koneksi_ajax.php";

	$no = 1;
  $date = date('Y-m-d');
	$query = $con->prepare("SELECT barang.nama_brg, transaksi.tgl_trans, transaksi.waktu, barang.modal, barang.harga_jual, transaksi.jml, transaksi.diskon, transaksi.kasir from barang JOIN transaksi on (barang.kd_brg=transaksi.kd_brg) where tgl_trans = '$date' group by transaksi.kd_trans");
	$query->execute();
	while ($data = $query->fetch()) {

		$dis = $data['diskon'];
		if ($dis == '') {
			$dis = 0;
		} else {
			$dis = $data['diskon'];
		}

		$untung = $data['modal'] * $data['jml'];
		$sub = $data['harga_jual'] * $data['jml'];
		@$subku = $sub - ($sub * $dis) / 100;
		$keuntungan = $subku - $untung;
		$totalk[] = $keuntungan;
		$toti[] = $subku;
		// code...?>

      <tr>
        <td align="center"><?php echo $no ?></td>
        <td align="center"><?php echo $data['tgl_trans'] ?></td>
        <td align="center"><?php echo $data['waktu'] ?></td>
        <td align="center"><?php echo $data['kasir'] ?></td>
        <td align="center"><?php echo $data['nama_brg'] ?></td>
        <td align="center"><?php echo "Rp " . number_format($data['modal'], 2, ',', '.') . ""; ?></td>
        <td align="center"><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
        <td align="center"><?php echo $data['jml'] ?></td>
        <td align="center"><?php echo "$data[diskon] %"; ?></td>
        <td align="center"><?php echo "Rp " . number_format($subku, 2, ',', '.') . ""; ?></td>
        <td align="center"><?php echo "Rp " . number_format($keuntungan, 2, ',', '.') . ""; ?></td>
      </tr>

      <?php
$no++;
	}
	@$total = array_sum($toti);
	@$untungan = array_sum($totalk);
	?>
    <tfoot>
      <tr>

      <td class="bg-secondary"></td>
        <td class="bg-secondary"></td>
      <td class="bg-secondary"></td>
        <td class="bg-secondary"></td>
      <td class="bg-secondary"></td>
        <td class="bg-secondary"></td>
	        <td class="bg-secondary"></td>
          <td class="bg-secondary"></td>
            <td align="center" style="color:white; font-size:25px;" class="bg-secondary"><b>SubTotal :</b></td>
              <td class="bg-secondary" style="color:white; font-size:25px;" align="center"><?php echo "Rp " . number_format($total, 2, ',', '.') . ""; ?></td>
	              <td class="bg-secondary" style="color:white; font-size:25px;" align="center"><?php echo "Rp " . number_format($untungan, 2, ',', '.') . ""; ?></td>
            </tr>
    </tfoot>

 </table>
<br>
</div>
<div>

</div>
<?php } elseif (isset($_POST['go'])) {
	$rek = $_POST['rekap'];
	?>

  <table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
    <thead>
      <tr>
        <th style="text-align:center;" scope="col">No</th>
        <th style="text-align:center;" scope="col">Tanggal</th>
        <th style="text-align:center;" scope="col">Jam</th>
        <th style="text-align:center;" scope="col">Kasir</th>
        <th style="text-align:center;" scope="col">Nama Barang</th>
        <th style="text-align:center;" scope="col">Modal</th>
        <th style="text-align:center;" scope="col">Harga Jual</th>
        <th style="text-align:center;" scope="col">Qty</th>
        <th style="text-align:center;" scope="col">Diskon</th>
        <th style="text-align:center;" scope="col">Total</th>
        <th style="text-align:center;" scope="col">Keuntungan</th>
      </tr>
  </thead>
    <?php
include "config/koneksi_ajax.php";

	$no = 1;
	$query = $con->prepare("SELECT barang.nama_brg, transaksi.tgl_trans, transaksi.waktu, barang.modal, barang.harga_jual, transaksi.jml, transaksi.diskon, transaksi.kasir from barang JOIN transaksi on barang.kd_brg=transaksi.kd_brg where tgl_trans BETWEEN " . $_POST['rekap'] . "group by transaksi.kd_trans");
	$query->execute();
	function tanggal_indo($tanggal, $cetak_hari = false) {
		$hari = array(1 => 'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Ahad');
		$bulan = array(1 => "January",
			"February",
			"Maret",
			"April",
			"Mei",
			"Juni",
			"July",
			"Agustus",
			"September",
			"Oktober",
			"November",
			"Desember");
		$split = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}
	while ($data = $query->fetch()) {

		$dis = $data['diskon'];
		if ($dis == '') {
			$dis = 0;
		} else {
			$dis = $data['diskon'];
		}
		$untung = $data['modal'] * $data['jml'];
		$sub = $data['harga_jual'] * $data['jml'];
		@$subku = $sub - ($sub * $dis) / 100;
		$keuntungan = $subku - $untung;
		$totalk[] = $keuntungan;
		$tot[] = $subku;
		$tanggal1 = $data['tgl_trans'];
		// code...?>

       <tr>
         <td align="center"><?php echo $no ?></td>
         <td align="center"><?php echo tanggal_indo($tanggal1, true); ?></td>
         <td align="center"><?php echo $data['waktu'] ?></td>
         <td align="center"><?php echo $data['kasir'] ?></td>
         <td align="center"><?php echo $data['nama_brg'] ?></td>
         <td align="center"><?php echo "Rp " . number_format($data['modal'], 2, ',', '.') . ""; ?></td>
         <td align="center"><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
         <td align="center"><?php echo $data['jml'] ?></td>
         <td align="center"><?php echo "$data[diskon] %"; ?></td>
         <td align="center"><?php echo "Rp " . number_format($subku, 2, ',', '.') . ""; ?></td>
         <td align="center"><?php echo "Rp " . number_format($keuntungan, 2, ',', '.') . ""; ?></td>
       </tr>

       <?php
$no++;
		@$toti[] = $subku;
	}
	@$totali = array_sum($toti);
	@$untungan = array_sum($totalk);
	?>
     <tfoot>
       <tr>

       <td class="bg-secondary"></td>
         <td class="bg-secondary"></td>
         <td class="bg-secondary"></td>
         <td class="bg-secondary"></td>
       <td class="bg-secondary"></td>
         <td class="bg-secondary"></td>
	         <td class="bg-secondary"></td>
           <td class="bg-secondary"></td>
             <td align="center" style="color:white; font-size:20px;" class="bg-secondary"><b>SubTotal :</b></td>
               <td class="bg-secondary" style="color:white; font-size:20px;" align="center"><?php echo "Rp " . number_format($totali, 2, ',', '.') . ""; ?></td>
							 <td class="bg-secondary" style="color:white; font-size:20px;" align="center"><?php echo "Rp " . number_format($untungan, 2, ',', '.') . ""; ?></td>
</tr>
     </tfoot>

  </table>
  <br>
  <div class="float-right">
  <button class="btn btn-default bg-warning" data-toggle="modal" data-target="#<?=$rek;?>"><span class="btn-label"><i class="fas fa-calendar-plus"></i></span> Lap Qty Barang</button>
  </div>

  <div class="modal fade" id="<?=$rek;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Laporan Transaksi /Qty</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<table id="example" class="display table table-striped table-hover table-head-bg-info" >
    <thead>
      <tr>
        <th style="text-align:center;" scope="col">Tanggal</th>
        <th style="text-align:center;" scope="col">Nama Barang</th>
        <th style="text-align:center;" scope="col">Qty</th>
        <th style="text-align:center;" scope="col">Total</th>
        <th style="text-align:center;" scope="col">Keuntungan</th>
      </tr>
  </thead>
    <?php
include "config/koneksi_ajax.php";

	$no = 1;
	$query = $con->prepare("SELECT DISTINCT (transaksi.kd_brg), barang.nama_brg, transaksi.tgl_trans, barang.modal, barang.harga_jual, sum(transaksi.jml) as qty, transaksi.diskon from barang JOIN transaksi on barang.kd_brg=transaksi.kd_brg AND tgl_trans BETWEEN " . $_POST['rekap'] . "GROUP BY transaksi.kd_brg");
	$query->execute();
	while ($data = $query->fetch()) {

		$dis = $data['diskon'];
		if ($dis == '') {
			$dis = 0;
		} else {
			$dis = $data['diskon'];
		}
		$untung1 = $data['modal'] * $data['qty'];
		$sub = $data['harga_jual'] * $data['qty'];
		$subku = $sub - ($sub * $dis) / 100;
		$keuntungan1 = $subku - $untung1;
		$totalk1[] = $keuntungan1;
		$tot1[] = $subku;
		// code...?>

       <tr>
         <td align="center"><?php echo $data['tgl_trans'] ?></td>
         <td align="center"><?php echo $data['nama_brg'] ?></td>
         <td align="center"><?php echo $data['qty'] ?></td>
         <td align="center"><?php echo "Rp " . number_format($subku, 2, ',', '.') . ""; ?></td>
         <td align="center"><?php echo "Rp " . number_format($keuntungan1, 2, ',', '.') . ""; ?></td>
       </tr>

       <?php
$no++;
		@$toti1[] = $subku;
	}
	@$totali1 = array_sum($toti1);
	@$untungan1 = array_sum($totalk1);
	?>
       <tr>

         <td></td>

       <td ></td>
             <td align="center" style="color:red; font-size:20px;" ><b>SubTotal :</b></td>
               <td style="color:red; font-size:20px;" align="center"><?php echo "<b>Rp " . number_format($totali1, 2, ',', '.') . "</b>"; ?></td>
               <td style="color:red; font-size:20px;" align="center"><?php echo "<b>Rp " . number_format($untungan1, 2, ',', '.') . "</b>"; ?></td>
</tr>

  </table>
</div>
</div>
</div>
</div>

<form class="" action="config/tes.php" method="post">
  <input hidden type="text" name="rekap" value="<?php echo $_POST['rekap'] ?>">
   <button type="submit" style="position: center;" href='struk.php?kode=<?php echo "$kode"; ?>' class="btn btn-primary btn-border btn-round btn-md">
   <span class="btn-label">
   <i class="fas fa-file-excel"></i>
   </span>
   Convert To Excel
 </button>

</form>
  </div>


  <?php

}?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();
    dateformat = 'DD/MM/YYYY';


    function cb(start, end) {
        $('#reportrange').html(start.format('D MMMM YYYY') + ' - ' + end.format('MMMM D, YYYY'));

}

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari ini': [moment()],
           'Kemaren': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'per Minggu': [moment().subtract(6, 'days'), moment()],
           '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
           'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Kemaren': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale":{
          "format":"'YYYY-MM-DD'",
          "separator": " AND ",
          "monthNames":[
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Des"
          ],
        }
    }, cb);

    cb(start, end);

});
</script>

<script type="text/javascript">
  $('#Modal').modal('show');
</script>
  <script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>