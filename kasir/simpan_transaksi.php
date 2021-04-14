<?php

			if (@$_POST['simpan']) {
				include"koneksi.php";

				@$id_keluar = $_POST['id'];
				$kd_brg= $_POST['kode'];
				$tgl = date("Y-mm-d");
				$jumlah= $_POST['jml'];
				@$total_harga= $_POST['bayar'];

				$sql = "insert into barang_keluar value('$id_keluar', 
									'$kd_brg', 
									'$tgl', 
									'$jumlah', 
									'$total_harga')";
				$query = mysql_query($sql);
				if ($query) {
				include "cet/cetak.php";

				}else{
					echo "gagal";
				}
			}

	 ?>