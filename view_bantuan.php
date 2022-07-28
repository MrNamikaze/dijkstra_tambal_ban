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
            <h1 class="h3 mb-0 color">Daftar Konsumen</h1>
            <a href="testimoni.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kembali</a>
        </div>
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
            getLocationLokasi()
        //halaman view
        function getLocationLokasi() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPositionLokasi);

          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }

        function showPositionLokasi(position) {
            var coor = position.coords.longitude+', '+position.coords.latitude;
            mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNsM2Nrdnh1cjBpZTYzY3BhOTEyNmY2NGkifQ.MbKI1QY8hAACQaRANPF5rw';
            var map_lokasi = new mapboxgl.Map({
              container: 'map_lokasi',
              style: 'mapbox://styles/mapbox/streets-v11',
              center: [position.coords.longitude, position.coords.latitude],
              zoom: 14
            });

                mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNsM2Nrdnh1cjBpZTYzY3BhOTEyNmY2NGkifQ.MbKI1QY8hAACQaRANPF5rw';
                const geojson = {
                'type': 'FeatureCollection',
                'features': [
                <?php foreach($hasil as $b){
                    $id_tambal = $b['id'];
                    $nama = $b['id_user'];
                    $longitude = $b['longitude'];
                    $latitude = $b['latitude'];
                ?>
                {
                'type': 'Feature',
                'properties': {
                'message':
                '<a href="cari_rute.php?id=<?= $id_tambal?>" class="btn btn-primary" style="height: 20%">Cari rute terdekat</a>',
                'iconSize' : [40,40]
                },
                'geometry': {
                'type': 'Point',
                'coordinates': [
                <?= $longitude?>,
                <?= $latitude?>]
                }
                },
                <?php
                }
                ?>
                ]
                };
                 
                // Add markers to the map.
                for (const marker of geojson.features) {
                // Create a DOM element for each marker.
                const el = document.createElement('div');
                const width = marker.properties.iconSize[0];
                const height = marker.properties.iconSize[1];
                el.className = 'marker_lokasi';
                el.style.backgroundImage = `url(https://placekitten.com/g/${width}/${height}/)`;
                el.style.width = `40px`;
                el.style.height = `40px`;
                el.style.backgroundSize = '100%';
                 
                 
                // Add markers to the map.
                new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .addTo(map_lokasi)
                .setPopup(new mapboxgl.Popup().setHTML(marker.properties.message));
                }
        }
</script>
  <!-- /.content-wrapper -->