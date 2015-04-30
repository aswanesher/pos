<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$self       = $_SERVER['PHP_SELF'];
$page     = $_REQUEST['module'];
$page     = $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow     = $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";

$cari     = $_REQUEST['tcari'];

$qtmpil_barang="select * from barang where true";
if($cari!="") {
  $qtmpil_barang.=" and barang_nama like '$cari%'";
}
$qtmpil_barang.=" order by inc asc";  
$sqlnav=$qtmpil_barang;
$qtmpil_barang.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";
?>
<div class="span12">
<!-- BASIC -->
                    <div class="box border red">
                      <div class="box-title">
                        <h4><i class="fa fa-search"></i>Pencarian</h4>
                      </div>
                      <div class="box-body big">
                        <form class="form-inline" role="form" method="post" action="index.php?halaman=data_barang">
                          <div class="form-group">
                          <input name="tcari" value="<?php echo $cari; ?>" type="text" class="form-control" id="exampleInputEmail2" placeholder="Cari..">
                          <button name="bcari" type="submit" value="Cari" class="btn btn-inverse">Cari</button>
                          </div>
                          
                                                  
                        </form>
                      </div>
                    </div>
                    <!-- /BASIC -->
<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Data Barang</h3>
            </div>
<!-- /widget-header -->
            <div class="widget-content">    

      <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Barang Kode</th>
          <th>Barang nama</th>
          <th>Barang Kategori</th>
          <th colspan="2">
          <center><?php echo "<a class='btn btn-small btn-primary' href=index.php?halaman=form_data_master&kode=barang_insert>"; ?>
            <i class='btn-icon-only icon-pencil'> </i>tambah data
          <?php echo "</a>"; ?></center>
          </th>
        </tr>
      </thead>  
        <?php 
		
		$qp_brg=mysql_query($qtmpil_barang);
		$no=1;
		while($row1=mysql_fetch_array($qp_brg)){
		?>
    <tbody>
        <tr>
          <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[barang_id]"; ?></td>
          <td><?php echo "$row1[barang_nama]"; ?></td>
          <td><?php echo "$row1[barang_kategori]"; ?></td>
          <td><center><?php echo "<a class='btn btn-small btn-success' href=index.php?halaman=form_ubah_data&kode=barang_update&id=$row1[inc]><i class='btn-icon-only icon-edit'> </i>"; ?>
          	 ubah
			 <?php echo "</a></center>"; ?>
          </td>
          <td>
          <center><a class="btn btn-small btn-danger" href="<?php echo "proses.php?proses=barang_delete&id=$row1[inc]>"; ?>" onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')"><i class='btn-icon-only icon-trash'> </i>
          hapus
		  </a></center>
          </td>
        </tr>
        </tbody>
        <?php	$no++; } ?>
        <tr>
          <td colspan="8" align="center"><center><?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=data_barang&maxrow=$maxrow&status_absen=$status_absen&$start=$start&end=$end&show=data_barang.php");?></center></td>
        </tr>
      </table>
      </div>
</div>
</div>