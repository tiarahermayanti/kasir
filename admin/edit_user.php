<?php
include "config/koneksi_ajax.php";

$id = $_GET['id'];
$modal = $con -> prepare("select * from ak where id = '$id'");
$modal -> execute();
while ($r = $modal -> fetch()) {
  // code...

 ?>

 <div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
        <h2 class="modal-title" id="myModalLabel">Update Data User</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body">
          <form action="update_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">

            <div hidden readonly class="form-group form-group-default">
              <label>Kode User</label>
              <input readonly type="text" name="id" value="<?php echo "$r[id]"; ?>" class="form-control form-control-md" >
            </div>
            <div class="form-group form-group-default">
                <label>Nama User</label>
                <input type="text" name="nama" value="<?php echo "$r[name]"; ?>" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>Username</label>
                <input type="text" name="user" value="<?php echo "$r[username]"; ?>" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>Password</label>
                <input type="text" name="pass" value="" class="form-control form-control-md" >
              </div>
              <div class="form-group form-group-default">
                <label>Level</label>
                <input type="text" name="stok" value="<?php echo $r['level'] ?>" class="form-control form-control-md" >
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


            </div>


        </div>
    </div>
