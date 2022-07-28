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
            <h1 class="h3 mb-0 color">Edit Orderan</h1>
            <a href="orderan.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <form class="user" action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" 
                    placeholder="Nama Lengkap" value="<?= $hasil['nama']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" 
                    placeholder="Alamat" value="<?= $hasil['alamat']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="jenis_paket" name="jenis_paket" 
                    placeholder="Jenis Paket" value="<?= $hasil['jenis_paket']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="harga" name="harga" 
                    placeholder="Harga" value="<?= $hasil['harga']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa" 
                    placeholder="No WA" value="<?= $hasil['no_wa']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="deskripsi" name="deskripsi" 
                    placeholder="Pesan" value="<?= $hasil['deskripsi']?>">
            </div>
            <input type="submit" name="edit" class="btn btn-primary btn-user btn-block" value="Edit">
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
  <!-- /.content-wrapper -->