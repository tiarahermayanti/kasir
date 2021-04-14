<?php
include 'config/conn.php';
$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for ($bulan = 1; $bulan < 13; $bulan++) {
	$query = mysqli_query($conn, "select sum(jml) as jumlah from transaksi where MONTH(tgl_trans)='$bulan'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="../../assets/js/plugin/chart.js/Chart.js"></script>
	<script type="text/javascript" src="../../assets/js/plugin/chart.js/chart.min.js"></script>
</head>
<body>
	<div style="width: 900px;height: 900px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>,
backgroundColor: 'rgb(23, 125, 255)',
			borderColor: 'rgb(23, 125, 255)',

					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>