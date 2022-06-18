<?php 
	@ob_start();
	session_start();
    include 'config.php';
	if(!isset($_SESSION['status'])){
    } else {
        header('location:index.php');
    };
$result1 = mysqli_query($conn, "SELECT * FROM login");
while($data = mysqli_fetch_array($result1))
{
    $toko = $data['nama_toko'];
}
function ribuan ($nilai){
    return number_format ($nilai, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $toko ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="icon.ico" type="image/ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
<div class="container">
  <a class="navbar-brand px-3 bg-primary"><?php echo $toko ?></a>
  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarC" aria-controls="navbarC" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars muncul"></i>
    <i class="fa fa-times-circle fa-1x text-white close"></i>
  </button>

  <div class="collapse navbar-collapse" id="navbarC">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php">
        <span class="text-center d-block pt-2"><i class="fa fa-user fa-2x"></i></span>Login</a>
      </li>
    </ul>
  </div>
  </div>
</nav>

<br>

<div class="container">
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Data Produk </div>
    </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stock</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM kategori k, produk p WHERE k.idkategori=p.idkategori order by idproduk ASC");
                                while($d=mysqli_fetch_array($data_produk)){
                                    $idproduk = $d['idproduk'];
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['kode_produk'] ?></td>
                                        <td><?php echo $d['nama_produk'] ?></td>
                                        <td><?php echo $d['nama_kategori'] ?></td>
                                        <td><?php echo $d['stock'] ?></td>
                                        <td>Rp.<?php echo ribuan($d['harga_modal']) ?></td>
                                        <td>Rp.<?php echo ribuan($d['harga_jual']) ?></td>
                                        
                                    </tr>
                                    
                                    <!-- modal edit -->
                                    <div class="modal fade" id="editP<?php echo $idproduk ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTittle2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTittle2"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Edit Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-2">
                                                    <label>Kode Produk :</label>
                                                    <input type="hidden" name="idproduk" class="form-control" value="<?php echo $d['idproduk'] ?>">
                                                    <input type="text" name="kode_produk" class="form-control" value="<?php echo $d['kode_produk'] ?>" readonly>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Nama Produk :</label>
                                                    <input type="text" name="nama_produk" class="form-control" value="<?php echo $d['nama_produk'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Kategori Produk :</label>
                                                        <select name="idkategori" class="form-control" required>
                                                            <option value="<?php echo $d['idkategori'] ?>" class="small"><?php echo $d['nama_kategori'] ?></option>
                                                        <?php
                                                        $dataK=mysqli_query($conn,"SELECT * FROM kategori ORDER BY nama_kategori ASC")or die(mysqli_error());
                                                        while($dk=mysqli_fetch_array($dataK)){
                                                        ?>
                                                            <option value="<?php echo $dk['idkategori'] ?>" class="small"><?php echo $dk['nama_kategori'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-2 col-md-2 pr-0">
                                                        <label>Stock :</label>
                                                        <input type="number" name="stock" class="form-control" value="<?php echo $d['stock'] ?>" required>
                                                    </div>
                                                    <div class="col-5 col-md-5 pr-0">
                                                        <label>Harga Modal :</label>
                                                        <input type="number" name="harga_modal" value="<?php echo $d['harga_modal'] ?>" class="form-control" required>
                                                    </div>
                                                    <div class="col-5 col-md-5">
                                                        <label>Harga Jual :</label>
                                                        <input type="number" name="harga_jual" value="<?php echo $d['harga_jual'] ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                                                    <i class="fa fa-times mr-1"></i> Batal</button>
                                                <button type="submit" class="btn btn-primary btn-xs p-2" name="updateProduk">
                                                <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    <!-- end modal edit -->
                        <?php }?>
					</tbody>
                </table>
        </div>
</div>
<?php include 'template/footer.php';?>
</body>
</html>
