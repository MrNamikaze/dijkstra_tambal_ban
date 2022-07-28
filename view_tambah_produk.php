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
            <h1 class="h3 mb-0 color">Tambah produk</h1>
            <a href="produk.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <form class="user" action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" 
                    placeholder="Nama Paket">
            </div>
            <div class="form-group">
                <input type="number" step=0.1 class="form-control form-control-user" id="harga" name="harga" 
                    placeholder="Harga">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="kategori" name="kategori" 
                    placeholder="Kategori">
            </div>
            <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Tambah!!">
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
  <!-- /.content-wrapper -->