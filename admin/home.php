<?php 
include "config/conn.php";
?>
 <div class="card full-height" >
				<div class="card-body" >
					<div class="card-title">


						 <div class="card-header card-header-primary">
                  <h4 class="card-title"><marquee>Selamat Datang Owner..!</marquee></h4>
                  <p class="card-category">Dashboard Home, Menampilkan data serta grafik penjualan per Bulan!</p>
                </div>

          </div>
          </div>
      </div>
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                  </div>
                  <?php 
                  $query = mysqli_query($conn, "SELECT kd_brg, COUNT(kd_brg) as total from barang");
                  $data = mysqli_fetch_array($query);
                  $total1 = $data['total'];

                  $sql = mysqli_query($conn, "SELECT kd_brg, COUNT(kd_brg) as total from barang where stock <= 3");
                  $warning=mysqli_fetch_array($sql);
                  $war=$warning['total'];
                  ?>
                  <p class="card-category">Stock Warning</p>
                  <h3 class="card-title"><?=$war;?>/<?= $total1; ?>
                    <small></small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="../kasir/index.php?halaman=beli">Tambah stock...</a>
                  </div>
                </div>
              </div>
            </div>
            <?php 
            $today = date('Y-m-d');
            $a=0;
            $query = mysqli_query($conn, "SELECT barang.nama_brg, barang.modal, barang.harga_jual, transaksi.jml, transaksi.diskon FROM barang JOIN transaksi ON (barang.kd_brg=transaksi.kd_brg) WHERE transaksi.tgl_trans='$today' group by transaksi.kd_trans");
            while ($data = mysqli_fetch_array($query)) {
  // code...
$a++;
  $dis = $data['diskon'];
  if ($dis == '') {
    $dis = 0;
  } else {
    $dis = $data['diskon'];
  }
  $sub = $data['harga_jual'] * $data['jml'];
  $subku = $sub - ($sub * $dis) / 100;
  $tot[$a] = $subku;
}
@$total = array_sum($tot);
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Transaction</p>
                  <h3 class="card-title"><?php echo "" . number_format($total, 0, ',', '.') . ""; ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Hari ini..
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">!</p>
                  <h3 class="card-title">75</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Tracked from Github
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-twitter"></i>
                  </div>
                  <p class="card-category">!</p>
                  <h3 class="card-title">+245</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
							<div class="row">
							<div class="card col-md-7">
							<?php
include "grafik_bulan.php";
?>
</div>
<div class="col-md-5">
	<?php include "kal.php"; ?>
</div>
<br>

						</div>


</div>