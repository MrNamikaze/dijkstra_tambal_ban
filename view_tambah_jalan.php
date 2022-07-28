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
            <h1 class="h3 mb-0 color">Tambah Tambal Ban</h1>
            <a href="lokasi.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" ><i
                    class="fas fa-arrow-alt-circle-left fa-sm text-white-50"></i> Kemabali</a>
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
            <?php
            if($usr==2):
            ?>
            <div class="alert alert-danger" role="alert">
              Error!!
            </div>
            <?php endif;?>
        <form class="user" action="proses_jalan.php" method="POST" enctype="multipart/form-data">
            <input type="text" class="form-control" id="id_before" name="id_before" >
            <input type="text" class="form-control" id="id_after" name="id_after" >
            <div id='map_lokasi' style='width: 100%; height: 400px;'></div>
            <br>
            <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Tambah!!" style="width: 83%">
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
    function Test(){
            var longitude = document.getElementById("longitude").value;
            console.log(longitude)
    }
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

        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FnYWdhMTU5IiwiYSI6ImNsM2Nrdnh1cjBpZTYzY3BhOTEyNmY2NGkifQ.MbKI1QY8hAACQaRANPF5rw';
        const geojson = {
        'type': 'FeatureCollection',
        'features': [
        <?php
            $a = 0;
            foreach($hasil as $b){
            $id_tambal = $b['id'];
            $longitude = $b['longitude'];
            $latitude = $b['latitude'];
        ?>
        {
        'type': 'Feature',
        'properties': {
        'message': '<input type="text" name="id_tambal" id="id_tambal" value="<?= $id_tambal?>" hidden>'+
        '<a class="btn btn-primary" href="#" onclick="Test()">Click</a>',
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
        $a++;
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

        map_lokasi.on('load', () => {
            <?php
            foreach ($hasil3 as $c) {
                $id_jalan = $c['id'];
                $vertex_before = $c['vertex_before'];
                $vertex_after = $c['vertex_after'];
            ?>
            map_lokasi.addSource('<?= $id_jalan?>', {
            'type': 'geojson',
            'data': {
            'type': 'Feature',
            'properties': {},
            'geometry': {
            'type': 'LineString',
            'coordinates': [
            [<?php
                $sql4 = "SELECT * FROM vertex WHERE id = '$vertex_before'";
                $row = $db->prepare($sql4);
                $row->execute();
                $hasil4 = $row->fetch();
                $longitude_before = $hasil4['longitude'];
                $latitude_user = $hasil4['latitude'];
                echo $longitude_before.', '.$latitude_user;
            ?>],
            [<?php
                $sql5 = "SELECT * FROM vertex WHERE id = '$vertex_after'";
                $row = $db->prepare($sql5);
                $row->execute();
                $hasil5 = $row->fetch();
                $longitude_before2 = $hasil5['longitude'];
                $latitude_user2 = $hasil5['latitude'];
                echo $longitude_before2.', '.$latitude_user2;
            ?>],
            ]
            }
            }
            });
            map_lokasi.addLayer({
            'id': '<?= $id_jalan?>',
            'type': 'line',
            'source': '<?= $id_jalan?>',
            'layout': {
            'line-join': 'round',
            'line-cap': 'round'
            },
            'paint': {
            'line-color': '#888',
            'line-width': 8
            }
            });
            <?php
            }
            ?>
        });
    }
    var a = 1;
    function Test(){
        var id_tambal = document.getElementById("id_tambal").value
        if(a%2 == 0){
            document.getElementById("id_after").value = id_tambal;
        }
        else{
            document.getElementById("id_before").value = id_tambal;
        }
        a++
    }
</script>
  <!-- /.content-wrapper -->