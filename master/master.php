<head>

<link rel="stylesheet" media="screen" href="css/jquery.dataTables.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function sendValue (s,s2,s3,s4,s5,s6,s7,s8,s9,s10){

window.opener.document.getElementById('kd_brg').value = s;
window.opener.document.getElementById('nama').value = s2;
window.opener.document.getElementById('harga').value = s3;
window.close();
}
//  End -->
</script>
<body>

			<div class="modal-body">

		<table id="example" class="display" cellspacing="0">
			<thead>
		<tr>
			<th style="background-color:#1E90FF; color:white;">Kode Barang</th>
			<th style="background-color:#1E90FF; color:white;">Nama Barang</th>
			<th style="background-color:#1E90FF; color:white;">Harga Jual</th>
			<th style="background-color:#1E90FF; color:white;">Stock</th>
			<th style="background-color:#1E90FF; color:white;">Aksi</th>
		</tr>
		</thead>
		<?php
require "../config/conn.php";
$sqlMhs   = mysqli_query($conn, "SELECT * FROM barang ORDER BY kd_brg ASC");
while($datamhs = mysqli_fetch_array($sqlMhs))
{
?>
<tr>
<td align="center"><?php echo "$datamhs[kd_brg]" ?></td>
<td align="center"><?php echo "$datamhs[nama_brg]" ?></td>
<td align="center"><?php echo "$datamhs[harga_jual]" ?></td>
<td align="center"><?php echo "$datamhs[stock]" ?></td>
<td align="center">

    <a href="#" onClick="sendValue('<?php echo $datamhs['kd_brg']; ?>','<?php echo $datamhs['nama_brg']; ?>','<?php echo $datamhs['harga_jual']; ?>');"><span class="btn btn-success"><i class="icon-edit"></i>Pilih</span></a></td>


</tr>
<?php
}
?>

	</table>
</div>

<script type="text/javascript">
	$('#Modal').modal('show');
</script>
	<script>
$(document).ready(function(){
$('#example').dataTable();
});
</script>
