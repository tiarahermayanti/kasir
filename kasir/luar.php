<?php 
date_default_timezone_set('Asia/Jakarta');
$date=date('d-m-Y');
$jam=date('H:i');
?>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
</style>
<div class="page-inner">
  <div class="row">
    <div class="col-md-9">
      <div class="card full-height">
        <div class="card-body">
          <div class="card-title">


            <div class="card-sub">

               <div class="card-header card-header-primary">
                  <h4 class="card-title">Transaksi Pengeluaran Belanja</h4>
                  <p class="card-category">Harap selesaikan transaksi anda!</p>
                </div>
            </div>
<div class="row">
            <div class="col-md-12">

          <form role="form" action="index.php?halaman=jajan"  method="post">
          	<input hidden type="text" name="id">


          	
          	<div class="form-group form-group-default">
          		<input readonly placeholder="Tanggal" type="text" name="waktu" class="form-control" value="<?= $date; ?>">
          	</div>
            <div class="form-group form-group-default">
              <input readonly placeholder="Jam" type="text" name="jam" class="form-control" value="<?= $jam; ?>">
            </div>
          	<div class="form-group form-group-default">
               <input id="harga" class="form-control" name="jenis" placeholder="Jenis Pengeluaran" name="pengeluaran">
          	</div>
          	<div class="form-group form-group-default">
               <input placeholder="Total"  class="form-control" name="total" id="jml" >
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