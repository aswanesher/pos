<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
</style>

</head>

<body>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;

	$beli="SELECT * FROM beli WHERE beli_id='$_GET[id]' order by inc asc";
	$qbeli=mysql_query($beli);
	$data=mysql_fetch_array($qbeli);
		

?>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td id="noBorder">No. Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[beli_id]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">No. Faktur</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[no_fak]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Tgl Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[tgl_trans]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Nama Supplier</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[supplier_nama]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Biaya Kirim/Ongkos truk</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "Rp "; echo digit($data['biaya_kirim']); ?></td>
  </tr>
</table>
    <table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField">Barang ID</td>
        <td id="namaField">Nama Buah</td>
        <td id="namaField">Kategori</td>
        <td id="namaField">Qty</td>
        <td id="namaField">Satuan</td>
        <td id="namaField">Harga satuan</td>
        <td id="namaField">Harga total</td>
      </tr>
      <?php 
		$pesan="SELECT * FROM beli_detail WHERE beli_id='$_GET[id]'";
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
        <td><?php echo "$row[barang_id]"; ?></td>
        <td><?php echo "$row[barang_nama]"; ?></td>
        <td><?php echo "$row[kategori]"; ?></td>
        <td><?php echo "$row[qty]"; ?></td>
        <td><?php echo "$row[satuan]"; ?></td>
        <td align="right"><?php echo digit($row['harga_satuan']);?></td>
        <td align="right"><?php echo digit($row['harga_total']); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td style="color:#FFF; background-color:#333; border:none" colspan="3" align="right">total Qty :</td>
        <td style="color:#FFF; background-color:#333; border:none">
        	<?php
				$sumQty="SELECT SUM(qty) AS totalQty FROM beli_detail WHERE beli_id='$_GET[id]'";
				$qsumQty=mysql_query($sumQty);
				$dsumQty=mysql_fetch_array($qsumQty);
				echo $dsumQty['totalQty'];
			?>
        </td>
        <td style="color:#FFF; background-color:#333; border:none">&nbsp;</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right">Total =</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right"><?php echo "Rp "; echo digit($data['total']); ?></td>
      </tr>
      <tr>
      	<td style="color:#FFF; background-color:#333; border:none" colspan="6" align="right">Total keseluruhan (total + ongkos truk) =</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right"><?php $alltotal=$data['total']+$data['biaya_kirim'];
	echo "Rp ";
	echo digit($alltotal); ?></td>
      </tr>
    </table>
</body>
</html>