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
            <h1 class="h3 mb-0 color">Tambah Gambar Testimoni</h1>
            <a href="detail_testimoni.php?id=<?= $id?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <form class="user" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" step=0.1 class="form-control form-control-user" id="nama" name="nama" 
                    placeholder="Harga" value="<?= $hasil1['nama']?>" hidden>
                <input type="text" step=0.1 class="form-control form-control-user" id="tanggal" name="tanggal" 
                    placeholder="Harga" value="<?= $hasil1['tanggal']?>" hidden>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="orderan" name="orderan" 
                    placeholder="Gedung" value="<?= $hasil1['orderan']?>" hidden>
            </div>
            <div class="form-row">
              <div class="col col-sm-4">
                <input type="file" name="gambar[]" accept="image/*" multiple>
              </div>
              <div class="col col-sm-4">
                <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Tambah!!">
              </div>
            </div>
            
        </form>
        <br>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil as $b){?>
            <tr>
              <th scope="row" style="color: black"><?= $a?></th>
              <td style="color: black"><?= $b['nama'];?></td>
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