<?php
	if ($_SESSION['level'] == "admin")
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<div id="judulHalaman"><strong><?php echo "Data Barang Masuk: tanggal ".$_POST['tgl_awal']." sampai dengan ".$_POST['tgl_akhir'];?></strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
    <?php echo "<a href=index.php?halaman=barang_masuk>"; ?><div id="tombolAdd">kembali</div><?php echo "</a>"; ?>
<table cellpadding="0" cellspacing="1">
  <tr>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Fak</td>
    <td id="namaField">Tgl. Trans</td>
    <td id="namaField">Nama Supplier</td>
    <td id="namaField">Biaya kirim/Ongkos truk</td>
    <td id="namaField">Total Harga</td>
  </tr>
  <?php 
  		$pesan="SELECT * FROM beli WHERE tgl_trans BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]'";
		$query=mysql_query($pesan);
		
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('beli_detail.php?id=<?php echo $row['beli_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['beli_id']; ?></a></td>
    <td><?php echo "$row[no_fak]"; ?></td>
    <td><?php echo "$row[tgl_trans]"; ?></td>
    <td><?php echo "$row[supplier_nama]"; ?></td>
    <td align="right"><?php echo digit($row['biaya_kirim']); ?></td>
    <td align="right"><?php echo digit($row['total']); ?></td>
  </tr>
  <?php } 
  	$sum1="SELECT SUM(biaya_kirim) AS total_ongkos FROM beli WHERE tgl_trans BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]'";
	$qsum1=mysql_query($sum1);
	$dsum1=mysql_fetch_array($qsum1);
	$sum2="SELECT SUM(total) AS total_harga FROM beli WHERE tgl_trans BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]'";
	$qsum2=mysql_query($sum2);
	$dsum2=mysql_fetch_array($qsum2);
  ?>
  <tr>
    <td style="color:#FFF; background-color:#333; border:none;" colspan="4" align="right" id="tabel_judul">Total :</td>
    <td style="color:#FFF; background-color:#333; border:none;" align="right"><?php echo "Rp ".digit($dsum1['total_ongkos']); ?></td>
    <td style="color:#FFF; background-color:#333; border:none;" align="right"><?php echo "Rp ".digit($dsum2['total_harga']); ?></td>
  </tr>
</table>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>