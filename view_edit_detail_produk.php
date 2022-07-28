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
            <h1 class="h3 mb-0 color">Edit Detail Produk</h1>
            <a href="detail_produk.php?id=<?= $back?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <?php if($not==2):?>
        <div class="alert alert-danger" role="alert">
          Invalid email/password!!
        </div>
        <?php endif;?>
        <?php
        if($not==1):
        ?>
        <div class="alert alert-success" role="alert">
          Sukses dirubah!!
        </div>
        <?php endif;?>
        <form class="user" action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" 
                    placeholder="Nama Paket" value="<?= $hasil['nama']?>">
            </div>
            <div class="form-group">
                <input type="number" step=0.1 class="form-control form-control-user" id="harga" name="harga" 
                    placeholder="Harga" value="<?= $hasil['harga']?>" hidden>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="gedung" name="gedung" 
                    placeholder="Gedung" value="<?= $hasil['gedung']?>" hidden>
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