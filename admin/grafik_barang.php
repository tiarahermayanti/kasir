<?php
include 'config/conn.php';
$bln1 = date('M', strtotime('-1 month'));
$bln = date('m', strtotime('-1 month'));
$produk = mysqli_query($conn, "select * from barang");
while ($row = mysqli_fetch_array($produk)) {

	$nama_produk[] = $row['nama_brg'];

	$query = mysqli_query($conn, "select transaksi.kd_brg, barang.nama_brg, sum(transaksi.jml) as jumlah from transaksi JOIN barang ON barang.kd_brg=transaksi.kd_brg WHERE month(transaksi.tgl_trans)='" . $bln . "'AND year(transaksi.tgl_trans)='" . 2020 . "' GROUP BY transaksi.kd_brg");
	$row1 = $query->fetch_array();
	$data = $row1['nama_brg'];
	$jumlah_produk[] = $row1['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="../assets/js/plugin/chart.js/Chart.js"></script>
	<script type="text/javascript" src="../assets/js/plugin/chart.js/chart.min.js"></script>
</head>
<body>
	<h1><?=$bln;?></h1>
	<div style="width: 1200px;height: 800px">
		<canvas id="myChart1"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart1").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($data); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>,
					borderColor: "#1d7af3",
			pointBorderColor: "#FFF",
			pointBackgroundColor: "red",
			pointBorderWidth: 2,
			pointHoverRadius: 4,
			pointHoverBorderWidth: 1,
			pointRadius: 4,
			backgroundColor: 'transparent',
			fill: true,
			borderWidth: 2

				}]
			},
			options : {
		responsive: true,
		maintainAspectRatio: false,
		legend: {
			position: 'bottom',
			labels : {
				padding: 10,
				fontColor: '#1d7af3',
			}
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:15,right:15,top:15,bottom:15}
		}
	}

		});
	</script>
</body>
</html>