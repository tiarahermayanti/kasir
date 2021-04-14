

          <script type="text/javascript" src="../assets/js/core/jquery.3.2.1.min.js"></script>
          <script type="text/javascript" src="../assets/js/core/bootstrap.min.js"></script>
          </head>
          <body>
            <?php
            include "config/conn.php";
             ?>
            <div class="page-inner mt--4">
            	<div class="row mt--2">
            		<div class="col-md-12">
            			<div class="card full-height">
            				<div class="card-body">
            					<div class="card-title">


            						<div class="card-sub">
                       
            						<div class="card-header card-header-primary">
                           <div style="float:right;" class="">

                        <button class="btn btn-warning" data-toggle="modal" data-target="#brgBaru"><span class="btn-label"><i class="fas fa-calendar-plus"></i></span> Tambah User</button>
                      </div>
                  <h4 class="card-title">Konfigurasi User</h4>
                  <p class="card-category">Manage data user!</p>
                </div>
              </div>

            						</div>
                      <div class="row">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover table-head-bg-secondary" >
                  <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                      </tr>
                    </thead>
          <?php
            //menampilkan data mysqli
            $no = 0;
            $modal=mysqli_query($conn, "SELECT * FROM `ak` order by id ASC");
            while($r=mysqli_fetch_array($modal)){
            $no++;

          ?>
            <tr>
                <td align="center">
                  <?php
                  if ($r['level'] == 'Admin') {
                    echo "<button hidden>admin</button>";
                  }else{
                    ?>
                    <a href="#" onclick="confirm_modal('hapus.php?&id=<?php echo  $r['id']; ?>');">
                      <button class="btn btn-danger btn-border btn-round">
                        <span class="btn-label">
                                  <i class="fa fa-trash"></i>
                                  </span>
                        Hapus</button>
                    </a>
                  <?php } ?>
                    <a hidden href="#" class='open_modal' id='<?php echo  $r['id']; ?>'>
                      <button class="btn btn-info btn-border btn-round">
                        <span class="btn-label">
                                  <i class="fas fa-pen"></i>
                                  </span>
                        Edit</button>
                    </a>
                </td>
                <td><?php echo  $r['name']; ?></td>
                <td><?php echo $r['username'] ?></td>
                <td><?php echo $r['level'] ?></td>
            </tr>


          <?php } ?>
          </table>
          </div>

          <!-- Modal Popup untuk Add-->
          <div class="modal fade" id="brgBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          	<div class="modal-dialog" role="document">
          		<div class="modal-content">
          			<div class="modal-header">
          				<h2 class="modal-title" id="exampleModalLabel">Tambah User Baru</h2>
          				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          					<span aria-hidden="true">&times;</span>
          				</button>
          			</div>
          			<div class="modal-body">
                  <form action="userbaru.php" name="modal_popup" enctype="multipart/form-data" method="POST">
<input hidden type="text" name="id" value="">
                    <div class="form-group form-group-default">
                        <label>Nama User</label>
                        <input type="text" name="nama" class="form-control form-control-md" placeholder="Nama User">
                      </div>
                      <div class="form-group form-group-default">
                        <label>Username</label>
                        <input type="text" name="user" class="form-control form-control-md" placeholder="Username">
                      </div>
                      <div class="form-group form-group-default">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control form-control-md" placeholder="Password">
                      </div>
                      <div class="form-group form-group-default">
                        <label>Ulangi Password</label>
                        <input type="password" name="pass1" class="form-control form-control-md" placeholder="Password">
                      </div>
                      <div class="form-group form-group-default">
                        <label>Level</label>
                        <input readonly type="text" name="level" value="Kasir"  class="form-control form-control-md" placeholder="Stock">
                      </div>
                      </div>

                      <div class="modal-footer">
                <button type="submit" name="proses" class="btn btn-info" value="Tambahkan">Tambah</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" name="button">Batal</button>
                      </div>

                      </form>
          		</div>
          	</div>
          </div>
          <!-- Modal Popup untuk Edit-->
          <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          </div>

          <!-- Modal Popup untuk delete-->
          <td align="center">
          <div style="text-align:center;" class="modal fade" id="modal_delete">
            <div class="modal-dialog">
              <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <h1>Hapus Data..?</h1><br>
            <h1><i style="font-size:150px; color:red;" class="far fa-times-circle"></i> </h1>
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
          </td>



          <!-- Javascript untuk popup modal Edit-->
          <script type="text/javascript">
             $(document).ready(function () {
             $(".open_modal").click(function(e) {
                var m = $(this).attr("id");
          		   $.ajax({
              			   url: "edit_user.php",
              			   type: "GET",
              			   data : {id: m,},
              			   success: function (ajaxData){
                			   $("#ModalEdit").html(ajaxData);
                			   $("#ModalEdit").modal('show',{backdrop: 'true'});
                		   }
              		   });
                  });
                });
          </script>

          <!-- Javascript untuk popup modal Delete-->
          <script type="text/javascript">
              function confirm_modal(delete_url)
              {
                $('#modal_delete').modal('show', {backdrop: 'static'});
                document.getElementById('delete_link').setAttribute('href' , delete_url);
              }
          </script>


        </div>
      </div>
    </div>
  </div>
</div>
