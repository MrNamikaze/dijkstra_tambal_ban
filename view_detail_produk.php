<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <br>
        <div class="row" style="width: 100%">
            <h1 class="col-9 h3 mb-0 color">Detail Produk <?= $hasil1['nama']?></h1>
            <a href="tambah_detail_produk.php?id=<?= $id?>" class="col d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah produk</a>
            <a href="produk.php" class="col d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <br>
        
        <?php
        ?>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil as $b){?>
            <tr>
              <th scope="row" style="color: black"><?= $a?></th>
              <td style="color: black"><?= $b['nama'];?></td>
              <td ><a href="edit_detail_produk.php?id=<?= $b['id'];?><?= $id_del?>" class="btn btn-success">Edit</a>&nbsp;<a class="btn btn-danger" href="delete_detail_produk.php?id=<?= $b['id'];?><?= $id_del?>">Delete</a></td>
            </tr>
            <?php $a++; }?>
          </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
  <!-- /.content-wrapper -->