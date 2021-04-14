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
<div class="page-inner">
	<div class="row mt--2">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">


						<div class="card-sub">

               <div class="card-header card-header-primary">
                  <h4 class="card-title">Transaksi Pengeluaran</h4>
                  <p class="card-category">Semua transaksi tercatat disini!</p>
                </div>
            </div>
          <div class="row">
            <div class="table-responsive">
        				<table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
        					<thead>
        							<tr>
        								<th scope="col">No</th>
        								<th scope="col">Waktu</th>
        								<th scope="col">Keperluan</th>
        								<th scope="col">Harga</th>
                        <th>#</th>
        							</tr>
        						</thead>
                    <?php
                    $no=1;
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
@$query = mysqli_query($conn, "select * from pengeluaran order by id DESC");
while (@$data = mysqli_fetch_array(@$query)) {
	// code...
$tglku=$data['waktu'];
	
	?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><?php echo "".tanggal_indo($tglku, true)." <b>Jam</b> ".$data['jam']." WIB"; ?></td>
                      <td><?php echo $data['jenis']; ?></td>
                      <td><?php echo "Rp. " . number_format($data['total'], 0, ',', '.') . ""; ?></td>
                      <td>#</td>
                    </tr>
                  <?php
                  $no++;
                  $sub[]=$data['total'];
}
@$total = array_sum($sub);
?>

                  <tfoot>
                    <td  class="bg-secondary"></td>
                      <td  class="bg-secondary"></td>
                        <td style="color: white;" class="bg-secondary"><h4>Total Pengeluaran :</h4></td>
                          <td style="color: white;" class="bg-secondary"><h4><?php echo "Rp. " . number_format($total, 2, ',', '.') . ""; ?></h4></td>
                            <td  class="bg-secondary"></td>
                  </tfoot>
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
