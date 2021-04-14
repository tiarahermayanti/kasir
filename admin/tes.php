<?php
$tgl = $_POST['rekap'];
//teks yang akan kita ganti

//Memperbaiki kata Teima

$tglbaru = str_replace("AND", "Sampai", $tgl);

require "Content-type: application/vnd-ms-excel";
require 'Content-Disposition: attachment; filename=hasil' . $tglbaru . '.xls';
?>
<h1 align="center">REKAPITULASI DATA PENJUALAN</h1>
<table border="1" cellspacing="0" >
<li>Tanggal <?php echo "$tglbaru"; ?></li>
  <thead>
    <th style="text-align:center;" scope="col">No</th>
    <th style="text-align:center;" scope="col">Tanggal</th>
    <th style="text-align:center;" scope="col">Nama Barang</th>
    <th style="text-align:center;" scope="col">Modal</th>
    <th style="text-align:center;" scope="col">Harga</th>
    <th style="text-align:center;" scope="col">Qty</th>
    <th style="text-align:center;" scope="col">Diskon</th>
    <th style="text-align:center;" scope="col">Total</th>
    <th style="text-align:center;" scope="col">Keuntungan</th>
</thead>
<?php
include "config/koneksi_ajax.php";

$no = 1;
$query = $con->prepare("SELECT barang.nama_brg, transaksi.tgl_trans, barang.modal, barang.harga_jual, transaksi.jml, transaksi.diskon from barang JOIN transaksi ON barang.kd_brg=transaksi.kd_brg WHERE tgl_trans BETWEEN " . $tgl . "GROUP By transaksi.kd_trans");
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
	$subku = $sub - ($sub * $dis) / 100;
	$keuntungan = $subku - $untung;
	$totalk[] = $keuntungan;
	$tot[] = $subku;
	// code...?>

   <tr>
     <td align="center"><?php echo $no ?></td>
     <td align="center"><?php echo $data['tgl_trans'] ?></td>
     <td align="center"><?php echo $data['nama_brg'] ?></td>
     <td align="center"><?php echo "Rp " . number_format($data['modal'], 2, ',', '.') . ""; ?></td>
     <td align="center"><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
     <td align="center"><?php echo $data['jml'] ?></td>
     <td align="center"><?php echo $dis;
	echo '%'; ?></td>
     <td align="center"><?php echo "Rp " . number_format($sub, 2, ',', '.') . ""; ?></td>
     <td align="center"><?php echo "Rp " . number_format($keuntungan, 2, ',', '.') . ""; ?></td>
   </tr>

   <?php
$no++;

}
$total = array_sum($tot);
$untungan = array_sum($totalk);
?>


   <td class="bg-secondary"></td>
     <td class="bg-secondary"></td>

   <td class="bg-secondary"></td>
     <td class="bg-secondary"></td>
       <td class="bg-secondary"></td>
         <td class="bg-secondary"></td>
         <td align="center"  style="font-size:25px;" class="bg-secondary"><b>SubTotal :</b></td>
           <td class="bg-secondary" style="font-size:25px;" align="center"><?php echo "Rp " . number_format($total, 2, ',', '.') . ""; ?></td>
           <td class="bg-secondary" style="font-size:25px;" align="center"><?php echo "Rp " . number_format($untungan, 2, ',', '.') . ""; ?></td>


</table>
