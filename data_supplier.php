<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";


$self       = $_SERVER['PHP_SELF'];
$page     = $_REQUEST['module'];
$page     = $_REQUEST['page']?$_REQUEST['page']:"1";
$maxrow     = $_REQUEST['maxrow']?$_REQUEST['maxrow']:"10";

$cari     = $_REQUEST['tcari'];

$qtmpil_sup="select * from supplier where true";
if($cari!="") {
  $qtmpil_sup.=" and supplier_nama like '%$cari%' or supplier_kota like '$cari%'";  
}
$qtmpil_sup.=" order by inc asc"; 
$sqlnav=$qtmpil_sup;
$qtmpil_sup.=$page?" LIMIT ".$maxrow." offset ".(($page-1)*$maxrow)."":"";
?>

<div class="span12">

<div class="box border red">
                      <div class="box-title">
                        <h4><i class="fa fa-search"></i>Pencarian</h4>
                      </div>
                      <div class="box-body big">
                        <form class="form-inline" role="form" method="post" action="index.php?halaman=data_supplier">
                          <div class="form-group">
                          <input name="tcari" value="<?php echo $cari; ?>" type="text" class="form-control" id="exampleInputEmail2" placeholder="Cari..">
                          <button name="bcari" type="submit" value="Cari" class="btn btn-inverse">Cari</button>
                          </div>
                          
                                                  
                        </form>
                      </div>
                    </div>

<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Data Supplier</h3>
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
          <?php echo "<a class='btn btn-small btn-primary' href=index.php?halaman=form_data_master&kode=supplier_insert>"; ?>
            <i class='btn-icon-only icon-pencil'> </i>tambah data
          <?php echo "</a>"; ?> </center> 
          </th>
        </tr>
        </thead>
        <?php 
		$qp_sup=mysql_query($qtmpil_sup);
		
		while($row2=mysql_fetch_array($qp_sup)){
		?>
        <tbody>
        <tr>
          <td><?php echo "$row2[supplier_nama]"; ?></td>
          <td><?php echo "$row2[supplier_alamat]"; ?></td>
          <td><?php echo "$row2[supplier_email]"; ?></td>
          <td><?php echo "$row2[supplier_kontak]"; ?></td>
          <td><center><?php echo "<a class='btn btn-small btn-success' href=index.php?halaman=form_ubah_data&kode=supplier_update&id=$row2[supplier_id]>"; ?>
          		<i class='btn-icon-only icon-edit'> </i>ubah
			  <?php echo "</a>"; ?></center>
          </td>
          <td><center><?php echo "<a class='btn btn-small btn-danger' href=proses.php?proses=supplier_delete&id=$row2[supplier_id]>"; ?>
          		<div onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')"><i class='btn-icon-only icon-trash'> </i>hapus</div>
			  <?php echo "</a>"; ?></center>
          </td>
        </tr>
        </tbody>
        <?php } ?>
        <tr>
          <td colspan="5" align="center"><center><?php _navpage($koneksi,$sqlnav,$maxrow,$page,"?halaman=data_supplier&maxrow=$maxrow&status_absen=$status_absen&$start=$start&end=$end&show=data_barang.php");?></center></td>
        </tr>
      </table>
      </div>
      </div>
</div>