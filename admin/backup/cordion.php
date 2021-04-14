<div class="accordion accordion-secondary col-sm-12">
							<div class="card">
								<div class="card-header collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
									<div class="span-icon">
										<div class="flaticon-box-1"></div>
									</div>
									<div class="span-title">
										Data Stock Warning
									</div>
									<div class="span-mode"></div>
								</div>

								<div class="active" id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

									<div class="card-body">

										<div class="table-responsive">
												<table id="basic-datatables" class="display table table-striped table-hover table-head-bg-primary" >
													<thead>
															<tr>
																<th scope="col"></th>
																<th scope="col">Kode Barang</th>
																<th scope="col">Nama Barang</th>
																<th scope="col">Modal</th>
																<th scope="col">Harga Jual</th>
																<th scope="col">Stock</th>
																<th scope="col">Status</th>
															</tr>
														</thead>
														<?php
require "config/conn.php";
$query = mysqli_query($conn, "SELECT * FROM barang where stock <= 5");
while ($data = mysqli_fetch_array($query)) {
	// code...
	?>
														<tr>
															<td align="center"> </td>
															<td><?php echo $data['kd_brg'] ?></td>
															<td><?php echo $data['nama_brg'] ?></td>
															<td><?php echo "Rp " . number_format($data['modal'], 2, ',', '.') . ""; ?></td>
															<td><?php echo "Rp " . number_format($data['harga_jual'], 2, ',', '.') . ""; ?></td>
															<td><?php echo "$data[stock]"; ?></td>
															<td> <button disabled type="button" class="btn btn-danger" name="button">Warning</button> </td>
														</tr>
													<?php }?>
													</table>
												</div>

									</div>
								</div>
							</div>
						</div>