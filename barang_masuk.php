<?php

$self           = $_SERVER['PHP_SELF'];
$page           = $_REQUEST['module'];
$page           = $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow         = $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";

$tgl_awal           = $_REQUEST['tgl_awal'];
$tgl_akhir          = $_REQUEST['tgl_akhir'];

$pesan="SELECT * FROM beli where true";
$sqlnav=$pesan;
$pesan.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";
$query=mysql_query($pesan);


?>

<div class="span12">

<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-long-arrow-down"></i>
              <h3>Cari Barang Masuk</h3>
            </div>
<!-- /widget-header -->
            <div class="widget-content">     
	
    <form id="form1" name="form1" method="post" action="index.php?halaman=barang_masuk_cari">
    <input name="proses" type="hidden" value="form1" />
      <table border="0" cellpadding="10">
        <tr>
          <td><input name="tgl_awal" placeholder="Tanggal awal" id="datepicker" type="text" /></td>
          <td><input name="tgl_akhir" placeholder="Tanggal akhir" id="datepicker1" type="text" /></td>
          <td><input name="tampil" id="tombol" type="submit" value="Tampilkan" class="btn btn-small btn-success"/>&nbsp;<a href="form_beli.php" class="btn btn-small btn-success"><i class='btn-icon-only icon-plus'> </i>tambah data
  </a></td>
        </tr>
      </table>
    </form> 
</div>
</div>    

<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-long-arrow-down"></i>
              <h3>Barang Masuk</h3>
            </div>
<!-- /widget-header -->
            <div class="widget-content">       
<table class="table table-striped table-bordered">
<thead>
  <tr>
    <th>No.Trans</th>
    <th>No.Fak</th>
    <th>Tgl. Trans</th>
    <th>Nama Supplier</th>
    <th>Biaya kirim/Ongkos truk</th>
    <th>Total Harga</th>
  </tr>
</thead>
<?php 
  		
		while($row=mysql_fetch_array($query)){
?>
  <tr>
    <td><center><a class="btn btn-small btn-danger" href="#" onclick="javascript:wincal=window.open('beli_detail.php?id=<?php echo $row['beli_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <i class='btn-icon-only icon-search'> </i><?php echo $row['beli_id']; ?></a></center>
    </td>
    <td><?php echo "$row[no_fak]"; ?></td>
    <td><?php echo "$row[tgl_trans]"; ?></td>
    <td><?php echo "$row[supplier_nama]"; ?></td>
    <td><?php echo "Rp "; echo digit($row['biaya_kirim']); ?></td>
    <td><?php echo "Rp "; echo digit($row['total']); ?></td>
  </tr>
  <?php } ?>
  <tr>
              <td colspan="6" align="center"><center><?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=barang_masuk&maxrow=$maxrow&status_absen=$status_absen&$start=$start&end=$end&show=stok.php");?>
              </center></td>
              </tr>
</table>

</div>
</div>
</div>
