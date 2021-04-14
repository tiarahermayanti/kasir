<div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordion">

									<div class="card-body">

										<div class="table-responsive">
												<table id="basic-datatables" class="display table table-striped table-hover table-head-bg-info" >
													<thead>
															<tr>
																<th scope="col"></th>
																<th scope="col">Kode Barang</th>
																<th scope="col">Nama Barang</th>
																<th scope="col">Total</th>
																<th scope="col"></th>
															</tr>
														</thead>
														<?php
														require "config/conn.php";
														$m = date('m');
														$t = date('Y');
														$query = mysqli_query($conn, "SELECT transaksi.kd_brg, barang.nama_brg, SUM(transaksi.jml) AS qty from barang JOIN transaksi on barang.kd_brg=transaksi.kd_brg WHERE year(tgl_trans)=$t AND month(tgl_trans)=$m GROUP BY barang.kd_brg");
														while ($r = mysqli_fetch_array($query)) {
															// code...
														 ?>
														<tr>
															<td></td>
															<td><?php echo $r['kd_brg'] ?></td>
															<td><?php echo $r['nama_brg'] ?></td>
															<td><?php echo $r['qty'] ?></td>
															<td></td>
														</tr>
													<?php } ?>
													</table>
												</div>

									</div>
								</div>

                                <script type="text/javascript">
	$(document).ready(function() {
	  $('#basic-datatables').DataTable({
	  });

	  $('#multi-filter-select').DataTable( {
	    "pageLength": 5,
	    initComplete: function () {
	      this.api().columns().every( function () {
	        var column = this;
	        var select = $('<select class="form-control"><option value=""></option></select>')
	        .appendTo( $(column.footer()).empty() )
	        .on( 'change', function () {
	          var val = $.fn.dataTable.util.escapeRegex(
	            $(this).val()
	            );

	          column
	          .search( val ? '^'+val+'$' : '', true, false )
	          .draw();
	        } );

	        column.data().unique().sort().each( function ( d, j ) {
	          select.append( '<option value="'+d+'">'+d+'</option>' )
	        } );
	      } );
	    }
	  });
	});
	</script>