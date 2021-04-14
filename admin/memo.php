<link rel="stylesheet" media="screen" href="css/jquery.dataTables.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<style type="text/css">
  .page-inner{
    margin-top: -50px;
  }
  #cek {
    color: #32CD32;
  }
  #not {
    color: red;
  }
</style>
<body>
<div class="page-inner">
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-5">
      <div class="card full-height">
        <div class="card-body">
          <div class="card-title">


            <div class="card-sub">

               <div class="card-header card-header-primary">
                  <h4 class="card-title">Tambah Memo</h4>
                  <p class="card-category">Ketikan sebuah pesan yang harus dikerjakan Hari ini, besok, dll.!</p>
                </div>
            </div>
            
          <form role="form" action="index.php?halaman=memo_baru"  method="post">
          	<input hidden type="text" name="id">


          	<div class="form-group form-group-default">
          	</div>
          	<div class="form-group form-group-default">
          		<input placeholder="Tanggal" required type="date" name="tgl" class="form-control" >
          	</div>
          	<div class="form-group form-group-default">
               <input  class="form-control" placeholder="Isi Pesan" required name="memo" id="harga" >
          	</div>
          	<input hidden type="text" name="status" value="0">
          	<div class="form-group form-group-default">
          		<input type="submit" class="btn btn-info" name="pos" value="Tambahkan">
          		<input type="reset" class="btn btn-danger" value="Batal">
          	</div>
          </form>

          </div>
        </div>
      </div>
  </div>
    <div class="col-md-7">
      <div class="card full-height">
        <div class="card-body">
          <div class="card-title">
              <div class="card-sub">

               <div class="card-header card-header-primary">
                  <h4 class="card-title">Data Memo</h4>
                  <p class="card-category">Menampilkan semua data memo serta menampikan status memo.!</p>
                </div>
            </div>
              <table  id="example" cellspacing="0" class="display table table-striped table-hover table-head-bg-danger" >
              <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Isi Pesan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <?php
                $no = 1;
                require "config/conn.php";
                $query = mysqli_query($conn, "select * from memo order by id desc");
                while ($data = mysqli_fetch_array($query)) {
                  // code...
                    $status = $data['status'];
                 ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['tanggal'] ?></td>
                  <td><?php echo $data['memo'] ?></td>
                  <td align="center"><?php 
                  if ($status == 1) {
                    echo "<div id='cek'>
                   <i class='material-icons'>verified</i>
                   </div>";
                  }else{
                    echo "<div id='not'>
                   <i class='material-icons'>disabled_by_default</i>
                   </div>";
                  }
                  ?></td>
                  <td>
                    <a href="#" onclick="confirm_modal('hapus_memo.php?&kode=<?php echo $data['id']; ?>');">
          <button class="btn btn-danger btn-border btn-round">
            <span class="btn-label">
                      <i class="material-icons">delete_forever</i>
                      </span>
            Hapus</button>
        </a>
                  </td>
                </tr>

<div style="text-align:center;" class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <h1>Hapus Data..?</h1><br>
  <h1><i style="font-size:150px; color:red;" class="material-icons">warning</i> </h1>
  <br>
  <br>
  <a style="color:white;" href="#" class="btn btn-danger" id="delete_link">Yaa.! Hapus data</a>
  <button type="button" class="btn btn-success" data-dismiss="modal">Cancel.!</button>
</div>
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">

      </div>
    </div>
  </div>
</div>

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
            <script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
<!-- Modal -->

						

	<script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>

