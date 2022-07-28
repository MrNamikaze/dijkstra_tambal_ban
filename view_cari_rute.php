<style type="text/css">
        .marker_lokasi {
        display: block;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
    }
    .mapboxgl-popup-content {
        position: relative;
        background: #fff;
        opacity: 0.3;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.10);
        padding: 10px 10px 15px;
        pointer-events: auto;
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
            <h1 class="h3 mb-0 color">Temukan Rute</h1>
            <a href="testimoni.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <form method="POST" action="perhitungan.php" enctype="multipart/form-data">
          <div class="after-add-more">
            <input type="text" name="lokasi" value="<?= $id?>" hidden>
          </div>
          <div class="copy" style="width: 1px; height: 1px">
                <input type="text" class="form-control" name="coordinates2[]" id="coordinates2[]" placeholder="Koordinat" hidden>
          </div>
          <button type="submit" class="btn btn-primary mb-2">Tambah</button>
        </form>
        <div id='map_lokasi' style='width: 100%; height: 400px;'></div>
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
        //
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNsM2Nrdnh1cjBpZTYzY3BhOTEyNmY2NGkifQ.MbKI1QY8hAACQaRANPF5rw';
        //
        map_lokasi.on('style.load', function() {
          map_lokasi.on('click', function(e) {
            var coordinates = e.lngLat;
            const marker = new mapboxgl.Marker()
            .setLngLat(coordinates)
            .setPopup(new mapboxgl.Popup().setHTML('you clicked here: <br/>' + coordinates))
            .addTo(map_lokasi);
            marker.togglePopup();
            var html = $(".copy").html();
            $(".after-add-more").after(html);
            document.getElementById("coordinates2[]").value = coordinates;
          });
        });
    }
    //
</script>
  <!-- /.content-wrapper -->