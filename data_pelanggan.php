<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$self       = $_SERVER['PHP_SELF'];
$page     = $_REQUEST['module'];
$page     = $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow     = $_REQUEST['maxrow']?$_REQUEST['maxrow']:"15";

$cari     = $_REQUEST['tcari'];

$qtmpil_pel="select * from pelanggan where true";
if($cari!="") {
  $qtmpil_pel.=" and pelanggan_nama like '%$cari%'";  
}
$qtmpil_pel.=" order by inc asc"; 
$sqlnav=$qtmpil_pel;
$qtmpil_pel.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";

?>

<div class="span12">

<div class="box border red">
                      <div class="box-title">
                        <h4><i class="fa fa-search"></i>Pencarian</h4>
                      </div>
                      <div class="box-body big">
                        <form class="form-inline" role="form" method="post" action="index.php?halaman=data_pelanggan">
                          <div class="form-group">
                          <input name="tcari" value="<?php echo $cari; ?>" type="text" class="form-control" id="exampleInputEmail2" placeholder="Cari..">
                          <button name="bcari" type="submit" value="Cari" class="btn btn-inverse">Cari</button>
                          </div>
                          
                                                  
                        </form>
                      </div>
                    </div>
</form>

<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Data Pelanggan</h3>
            </div>
<!-- /widget-header -->
            <div class="widget-content">    
      <table class="table table-striped table-bordered">
        <thead>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Email</th>
          <th>Kontak</th>
          <th colspan="2"><center>
          <?php echo "<a class='btn btn-small btn-primary' href=index.php?halaman=form_data_master&kode=pelanggan_insert>"; ?>
            <i class='btn-icon-only icon-pencil'> </i>tambah data
          <?php echo "</a>"; ?> </center> 
          </th>
        </tr>
        </thead>
        <?php 
		$qp_pel=mysql_query($qtmpil_pel);
		
		while($row3=mysql_fetch_array($qp_pel)){

		?>
    <tbody>
        <tr>
          <td><?php echo "$row3[pelanggan_nama]"; ?></td>
          <td><?php echo "$row3[pelanggan_alamat]"; ?></td>
          <td><?php echo "$row3[pelanggan_email]"; ?></td>
          <td><?php echo "$row3[pelanggan_kontak]"; ?></td>
          <td><center><?php echo "<a class='btn btn-small btn-success' href=index.php?halaman=form_ubah_data&kode=pelanggan_update&id=$row3[pelanggan_id]>"; ?>
          	  <i class='btn-icon-only icon-edit'> </i>ubah
			  <?php echo "</a>";?></center>
          </td>
          <td><center><?php echo "<a class='btn btn-small btn-danger' href=proses.php?proses=pelanggan_delete&id=$row3[pelanggan_id]>"; ?>
          	  <div onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')"><i class='btn-icon-only icon-trash'> </i>hapus</div>
			  <?php echo "</a>"; ?></center>
          </td>
        </tr>
        </tbody>
        <?php } ?>
        <tr>
          <td colspan="6" align="center"><center><?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=data_pelanggan&maxrow=$maxrow&status_absen=$status_absen&$start=$start&end=$end&show=data_barang.php");?></center></td>
        </tr>
      </table>
</div>
</div>
</div>