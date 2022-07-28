<style type="text/css">
    .marker_lokasi {
    display: block;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    padding: 0;
}
</style>
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
            <h1 class="h3 mb-0 color">Tambah Testimoni</h1>
            <a href="testimoni.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <form class="user" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleFormControlInput1">Nama tambal ban</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $hasil['nama']?>" placeholder="Nama tambal ban">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Alamat tambal ban</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $hasil['alamat']?>" placeholder="Alamat tambal ban">
              <input type="text" class="form-control" id="coordinates" name="coordinates" placeholder="Alamat tambal ban" hidden>
            </div>
            <br>
            <div id='map_lokasi' style='width: 100%; height: 400px;'></div>
            <br>
            <input type="submit" name="edit" class="btn btn-primary btn-user btn-block" value="Edit!!" style="width: 83%">
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css' rel='stylesheet' />
<script>
    getLocationTambahLokasi()
    function getLocationTambahLokasi() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPositionTambahLokasi);

      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPositionTambahLokasi(position) {
        var coor = position.coords.longitude+', '+position.coords.latitude;
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNsM2Nrdnh1cjBpZTYzY3BhOTEyNmY2NGkifQ.MbKI1QY8hAACQaRANPF5rw';
        var map_lokasi = new mapboxgl.Map({
          container: 'map_lokasi',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: [position.coords.longitude, position.coords.latitude],
          zoom: 14
        });

        map_lokasi.on('style.load', function() {
          map_lokasi.on('click', function(e) {
            var coordinates = e.lngLat;
            const marker = new mapboxgl.Marker()
            .setLngLat(coordinates)
            .setPopup(new mapboxgl.Popup().setHTML('you clicked here: <br/>' + coordinates))
            .addTo(map_lokasi);
            marker.togglePopup();
            document.getElementById("coordinates").value = coordinates;
          });
        });
    }
    //
</script>
  <!-- /.content-wrapper -->