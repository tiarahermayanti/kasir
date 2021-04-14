<?php 
date_default_timezone_set('Asia/Jakarta');

      include "config/conn.php";
?>
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
                    <a href="?halaman=beli">Tambah stock...</a>
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
                  <h3 class="card-title"><?php echo "Rp." . number_format($total, 0, ',', '.') . ""; ?></h3>
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
                  <p class="card-category">Fixed Issues</p>
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
                  <p class="card-category">Followers</p>
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
      <div class="row">
      <div class="col-lg-6 col-md-12">
      <div class="card">

                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Memo:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">bug_report</i> Hari ini
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">code</i> Kemaren
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons">cloud</i> Besok
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                      <table class="table">
                        <tbody>
                          <?php 
                          $date = date('Y-m-d');
      include "config/conn.php";
      $query = mysqli_query($conn, "select * from memo where tanggal='$date'");
      while ($data = mysqli_fetch_array($query)) {
        $isi = $data['memo'];
        $status = $data['status'];
        $kode = $data['id'];
                         ?>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <form method="post" action="?halaman=prosmemo">
                     
                                  <?php 
if($status == 1){
  
  echo "<input class='form-check-input' type='checkbox' checked >
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>";
}else{
  echo "<input class='form-check-input' type='checkbox' onchange='this.form.submit();'>
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>
                                  <input type='text' name='kode' value='$kode' hidden>";
}
                                  ?>
                                  </form>
                                </label>
                              </div>
                            </td>                            
                            <td><?= $isi; ?></td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit Task">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                              <?php } ?>                     
                          </tbody>
                      </table>
                    </div>
<!-- hari ini end -->
                    <div class="tab-pane" id="messages">
                      <table class="table">
                        <tbody>
                           <?php 
   $patang = date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))));
      include "config/conn.php";
      $query = mysqli_query($conn, "select * from memo where tanggal='$patang'");
      while ($data = mysqli_fetch_array($query)) {
        $isi = $data['memo'];
        $status = $data['status'];
        $kode = $data['id'];
                         ?>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">

                                  <form method="post" action="?halaman=prosmemo">
                     
                                  <?php 
if($status == 1){
  
  echo "<input class='form-check-input' type='checkbox' checked >
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>";
}else{
  echo "<input class='form-check-input' type='checkbox' onchange='this.form.submit();'>
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>
                                  <input type='text' name='kode' value='$kode' hidden>";
}
                                  ?>
                                  </form>

                                </label>
                              </div>
                            </td>
                            <td><?= $isi;?>
                            </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit Task">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                         <?php } ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane" id="settings">
                      <table class="table">
                        <tbody>
                          <?php 
$besok = date('Y-m-d', strtotime("+1 day", strtotime(date('Y-m-d'))));
      include "config/conn.php";
      $query = mysqli_query($conn, "select * from memo where tanggal='$besok'");
      while ($data = mysqli_fetch_array($query)) {
        $isi = $data['memo'];
        $status = $data['status'];
        $kode = $data['id'];
                         ?>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">

                                  <form method="post" action="?halaman=prosmemo">
                     
                                  <?php 
if($status == 1){
  
  echo "<input class='form-check-input' type='checkbox' checked >
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>";
}else{
  echo "<input class='form-check-input' type='checkbox' onchange='this.form.submit();'>
                                  <span class='form-check-sign'>
                                    <span class='check'></span>
                                  </span>
                                  <input type='text' name='kode' value='$kode' hidden>";
}
                                  ?>
                                  </form>

                                </label>
                              </div>
                            </td>
                            <td> <?= $isi; ?> </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit Task">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>




            <?php 
date_default_timezone_set('Asia/Jakarta');
$date=date('d F, Y ');
$tgl=date('d-m-Y');
?>
              <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Pengeluaran Hari ini</h4>
                  <p class="card-category"><?= $date;?></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <tr><th>No</th>
                      <th>Waktu</th>
                      <th>Jenis</th>
                      <th>Total</th>
                    </tr></thead>
                    <?php 
date_default_timezone_set('Asia/Jakarta');
$tgl=date('d-m-Y');
                    include "config/conn.php";
                    $no=1;
          $query = mysqli_query($conn, "select * from pengeluaran where waktu= '$tgl' order by id asc ");
          while ($data = mysqli_fetch_array($query)) {
                
                  ?>
                    <tbody>
                      <tr>
                   <td><?= $no;?></td>
                   <td><?= $data['waktu']; ?>: <?= $data['jam']; ?></td>  
                   <td><?= $data['jenis']; ?></td>   
                   <td><?php echo "Rp " . number_format($data['total'], 2, ',', '.') . ""; ?></td>
                      </tr>
                    </tbody>
                    <?php 
                    $no++;
                    $jml[]=$data['total'];
                  }
                  @$tot = array_sum($jml);
                    ?>
                    <tfoot>
                    <td></td>
                    <td></td>
                    <td><b>Sub Total :</b></td>
                    <td><b>
                    <?php echo "Rp " . number_format($tot, 2, ',', '.') . ""; ?></b>
                    </td>
                    
                  </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
