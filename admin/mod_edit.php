<?php
include "config/koneksi_ajax.php";

$kd_brg = $_GET['kd_brg'];
$modal = $con -> prepare("select * from barang where kd_brg = '$kd_brg'");
$modal -> execute();
while ($r = $modal -> fetch()) {
  // code...

 ?>

 <div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
        <h2 class="modal-title" id="myModalLabel">Update Data Barang</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body">
          <form action="update_brg.php" name="modal_popup" enctype="multipart/form-data" method="POST">

            <div readonly class="form-group form-group-default">
              <label>Kode Barang</label>
              <input readonly type="text" name="kode" value="<?php echo "$r[kd_brg]"; ?>" class="form-control form-control-md" >
            </div>
            <div class="form-group form-group-default">
                <label>Nama Menu</label>
                <input type="text" name="nama" value="<?php echo "$r[nama_brg]"; ?>" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>Modal</label>
                <input type="text" name="modal" value="<?php echo "$r[modal]"; ?>" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>Harga Jual</label>
                <input type="text" name="harga" value="<?php echo $r['harga_jual'] ?>" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>stock</label>
                <input type="text" name="stok" value="<?php echo $r['stock'] ?>" class="form-control form-control-md" >
              </div>

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    Confirm
	                </button>

	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Cancel
	                </button>
	            </div>

            	</form>
              <?php } ?>
             <?php
             if (isset($_POST['proses'])) {
               // code...
               echo "<script>
               alert('Haloo');
               </script>";
             }
             ?>


            </div>


        </div>
    </div>
