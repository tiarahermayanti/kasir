<?php
include "config/conn.php";
?>
<link rel="stylesheet" media="screen" href="../mastercss/jquery.dataTables.css"/>
<script type="text/javascript" src="../master/js/jquery.js"></script>
<script type="text/javascript" src="../master/js/jquery.dataTables.js"></script>

<meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
<meta content="Aguzrybudy" name="author"/>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript" src="../assets/js/core/bootstrap.min.js"></script>
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
                  <h4 class="card-title">Transaksi Penjualan</h4>
                  <p class="card-category">Semua transaksi tercatat disini!</p>
                </div>
            </div>
          <div class="row">
            <div class="table-responsive">
        				<table id="example" class="display table table-striped table-hover table-head-bg-secondary" >
        					<thead>
        							<tr>
        								<th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
        								<th scope="col">Nama Barang</th>
        								<th scope="col">Modal</th>
        								<th scope="col">Harga Jual</th>
        								<th scope="col">Qty</th>
        								<th scope="col">Detail</th>
        							</tr>
        						</thead>
                    <?php
                    $no=1;
$query = mysqli_query($conn, "select * from barang order by kd_brg desc");
while ($data = mysqli_fetch_array($query)) {
	// code...
$kode =  $data['kd_brg'];
	?>

                    <tr>
                      <td><?=$no;?></td>
                      <td><?php echo $data['kd_brg'] ?></td>
                      <td><?php echo $data['nama_brg'] ?></td>
                      <td><?php echo "Rp " . number_format($data['modal'], 2, ',', '.') . ""; ?></td>
                      <td><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
                      <td><?php echo $data['stock'] ?></td>
                      <td> 
    <a href="#" class='open_modal' id='<?php echo $data['kd_brg']; ?>'>
            <button class="btn btn-info btn-border btn-round">
              <span class="btn-label">
                        <i class="fas fa-eye"></i>
                        </span>
              Detail</button>
          </a>



                     </td>
                    </tr>




                  <?php
                  $no++;


}
?>

                
                  </table>
                </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
 </div> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "mod_detail.php",
             type: "GET",
             data : {kd_brg: m,},
             success: function (ajaxData){
               $("#ModalEdit").html(ajaxData);
               $("#ModalEdit").modal('show',{backdrop: 'true'});
             }
           });
        });
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