
<?php
$a=1;
$b=1;
include "../config/koneksi_ajax.php";

require 'pos/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;




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
    $tgl = date('H:i:m, d-F-Y');


    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    //$logi = EscposImage::load("img/logo.png", false);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    //$printer -> bitImage($logi);
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer -> text("\n");
    $printer -> text("LIZA KOSMETIK\n");

    $printer -> selectPrintMode();
    $printer -> text("Jl. SOEKARNO HATTA No.149E\n");
    $printer -> text("LABUAH BARU PAYAKUMBUH UTARA.\n");
    $printer -> text("KOTA PAYAKUMBUH.\n");
    $printer -> feed();

    $printer -> setEmphasis(true);
    $printer -> text("FAKTUR PENJUALAN\n");
    $printer -> text("Nota : KASIR-001 Kasir : FARHAT");
    $printer -> text("\n");
    $printer -> setEmphasis(false);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> setEmphasis(true);

    $printer -> setEmphasis(false);
    $printer -> feed();
    $printer -> text($tgl);
    $printer -> text("\n");
    $printer -> text("--------------------------------");

while ($r = $query->fetch()) {
                                                            // code...
            $nama = $r['nm_brg'];
            $harga = $r['harga_jual'];
            $jml = $r['jumlah'];
            $diskon = $r['diskon'];
            $total = $r['total_harga'];


            $printer -> text("".$nama."\n");
            $printer -> text("".$jml." x Rp.".number_format($harga,0,',','.')."  ".$diskon."%    Rp.".number_format($total,0,',','.')."\n");

}

    $printer -> text("--------------------------------");

    $printer -> feed();
    $printer -> setJustification(Printer::JUSTIFY_RIGHT);
    $printer -> setEmphasis(true);
$sum = $con->prepare("select sum(total) as sub from barang_keluar ");
$sum->execute();
while ($q = $sum->fetch()) {
    // code...
    $tot = $q['total_harga'];
    //$printer -> text("Pembayaran     : Rp.".number_format($bayar,2,',','.')."\n");
    $printer -> text("Total Belanja  : Rp.".number_format($tot,2,',','.')."\n");
    //$printer -> text("Uang Kembalian : Rp.".number_format($kembali,2,',','.')."\n");
}
    $printer -> setEmphasis(false);

    $printer -> feed();
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("*Terima Kasih atas Kunjunganya!*");
    $printer -> feed(5);

    $printer -> cut();

    /* Close printer */
    $printer -> close();

if ($a = $b) {
    # code...
    echo "<script>
history.go(-1);
    </script>";
}else{
    echo "<script>
history.go(-1);
    </script>";
}

    ?>
