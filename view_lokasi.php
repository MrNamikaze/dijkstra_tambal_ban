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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 color">Daftar Tambal</h1>
            <a href="tambah_lokasi.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah tambal ban</a>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil as $b){?>
            <tr>
              <th scope="row" style="color: black"><?= $a?></th>
              <td style="color: black"><?= $b['nama'];?></td>
              <td style="color: black"><?= $b['alamat'];?></td>
              <td style="color: black"><?= $b['status'];?></td>
              <td ><a href="edit_lokasi.php?id=<?= $b['id'];?>" class="btn btn-success">Edit</a>&nbsp;<a class="btn btn-danger" href="delete_lokasi.php?id=<?= $b['id'];?>">Delete</a></td>
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