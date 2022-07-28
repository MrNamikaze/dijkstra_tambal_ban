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
            <h1 class="h3 mb-0 color">Edit Testimoni</h1>
            <a href="testimoni.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <?php
            if($usr==1):
            ?>
            <div class="alert alert-success" role="alert">
              Sukses dirubah!!
            </div>
            <?php endif;?>
            <?php
            if($usr==3):
            ?>
            <div class="alert alert-danger" role="alert">
              Tanggal tidak boleh kosong!!
            </div>
            <?php endif;?>
        <form class="user" action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="col col-sm-2">
                <label for="paket">Nama Customer: </label>
              </div>
              <div class="col col-sm-8">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" 
                    placeholder="Nama Customer" value="<?= $hasil['nama']?>">
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="col col-sm-2">
                <label for="paket">Paket: </label>
              </div>
              <div class="col col-sm-8">
                 <select name="orderan" id="orderan">
                  <?php foreach($hasil1 as $b){?>
                    <?php if($hasil['orderan'] == $b['nama']){?>
                      <option value="<?= $b['nama']?>" selected><?= $b['nama']?></option>
                    <?php } else{?>
                      <option value="<?= $b['nama']?>"><?= $b['nama']?></option>
                    <?php }?>
                  <?php $a++; }?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="col col-sm-2">
                <label for="orderan">Tanggal order: </label>
              </div>
              <div class="col col-sm-8">
                <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" 
                    placeholder="Gedung" value="<?= $hasil['tanggal']?>">
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="col col-sm-2">
                <label for="orderan">Cover Testimoni: </label>
              </div>
              <div class="col col-sm-8">
                <input type="file" id="foto" name="foto" style="color: white">
              </div>
            </div>
            <br>
            <input type="submit" name="edit" class="btn btn-primary btn-user btn-block" value="Edit!!" style="width: 83%">
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
  <!-- /.content-wrapper -->