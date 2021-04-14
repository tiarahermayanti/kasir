<?php

include "config/koneksi_ajax.php";
include "config/conn.php";

require 'autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

$query = $con->prepare("SELECT * FROM `barang_keluar` order by id_keluar asc");
$query->execute();

/* Change to the correct path if you copy this example! */

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */

// Enter the share name for your USB printer here
//$connector = null;
$connector = new WindowsPrintConnector("POS58SERIES");

date_default_timezone_set('Asia/Jakarta');
$tgl = date('H:i:m,       d-F-Y');
$kode = date('d');
session_start();

/* Print a "Hello world" receipt" */
$printer = new Printer($connector);
//$logi = EscposImage::load("img/logo.png", false);
$printer->setJustification(Printer::JUSTIFY_CENTER);
//$printer -> bitImage($logi);
$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$logo = EscposImage::load("teo.jpg", false);
$printer->bitImageColumnFormat($logo);
$printer->text("THEOLIN BEAUTY\n");

$printer->selectPrintMode();
$printer->text("JLN. JEND. SOEDIRMAN No.149E\n");
$printer->text("BALAI CACANG PAYAKUMBUH UTARA\n");
$printer->text("KOTA PAYAKUMBUH\n");
$printer->feed();

$printer->setEmphasis(true);
$printer->text("FAKTUR PENJUALAN\n");
$printer->text("Nota : TRS-0" . $kode . "  Kasir : ". $_SESSION['username']);
$printer->text("\n");
$printer->setEmphasis(false);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);

$printer->setEmphasis(false);
$printer->feed();
$printer->text($tgl);
$printer->text("\n");
$printer->text("--------------------------------");

while ($r = $query->fetch()) {
	// code...
	$nama = $r['nm_brg'];
	$harga = $r['harga_jual'];
	$jml = $r['jumlah'];
	$diskon = $r['diskon'];

	$dis = $r['diskon'];
	if ($dis == '') {
		$dis = 0;
	} else {
		$dis = $r['diskon'];
	}
	$sub = $r['harga_jual'] * $r['jumlah'];
	$subku = $sub - ($sub * $dis) / 100;
	$tot[] = $subku;

	$printer->text("" . $nama . "\n");
	$printer->text("" . $jml . " x Rp." . number_format($harga, 0, ',', '.') . "  " . $diskon . "%    Rp." . number_format($subku, 0, ',', '.') . "\n");
	@$toti[] = $subku;
}

$printer->text("--------------------------------");

$printer->feed();
$printer->setJustification(Printer::JUSTIFY_RIGHT);
$printer->setEmphasis(true);

// code...
@$totali = array_sum($toti);
//$printer -> text("Pembayaran     : Rp.".number_format($bayar,2,',','.')."\n"););
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Total Belanja        : Rp. " . number_format($totali, 2, ',', '.') . "\n");
$printer->text("Bayar                : ". $_SESSION['bayar'] . "\n");
$printer->text("Kembali              : " . $_SESSION['kembali'] . "\n");


//$printer -> text("Uang Kembalian : Rp.".number_format($kembali,2,',','.')."\n");

$printer->setEmphasis(false);

$printer->feed();
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("*Terima Kasih atas Kunjungannya*");
$printer->feed();

$printer->cut();

/* Close printer */
$printer->close();

$query = mysqli_query($conn, "delete from barang_keluar ") or die(mysql_error());
//$query2 = mysql_query("delete from temp_bayar ") or die(mysql_error());
if ($query) {
	// code...
	echo "<meta http-equiv='refresh' content='0; ../index.php?halaman=jual'>";
}

?>
