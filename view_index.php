<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Creative - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style type="text/css">
            .marker_lokasi {
            display: block;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 0;
        }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Skripsi Tambal Ban</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item">
                            <form action="cari_bantuan.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="text" class="form-control" id="longitude" name="longitude" hidden>
                                <input type="text" class="form-control" id="latitude" name="latitude" hidden>
                                <button type="submit" class="btn btn-primary">Cari bantuan!!</button>
                            </form>
                        </li>
                        &emsp;
                        <li class="nav-item"><a class="btn btn-primary" href="login.php">Login</a></li>
                        &emsp;
                        <li class="nav-item"><a class="btn btn-primary" href="register.php">Register</a></li>
                        &emsp;
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <div id='map_lokasi' style='width: 100%; height: 100%;'></div>
        <!-- Bootstrap core JS-->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
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
            document.getElementById("longitude").value = position.coords.longitude;
            document.getElementById("latitude").value = position.coords.latitude;
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
                {
                'type': 'Feature',
                'properties': {
                'message': '<strong>Lokasi Anda Saat Ini</strong><br>',
                'iconSize' : [60,60]
                },
                'geometry': {
                'type': 'Point',
                'coordinates': [
                position.coords.longitude,
                position.coords.latitude]
                }
                },
                <?php foreach($hasil as $b){
                    $id_tambal = $b['id'];
                    $nama = $b['nama'];
                    $alamat = $b['alamat'];
                    $status = $b['status'];
                    $longitude = $b['longitude'];
                    $latitude = $b['latitude'];
                ?>
                {
                'type': 'Feature',
                'properties': {
                'message': '<strong>Nama: <?= $nama?></strong><br>'+
                '<strong>Alamat: <?= $alamat?></strong><br>'+
                '<strong>Status: <?= $status?></strong><br>',
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
                if(width==40){
                    el.style.backgroundColor = `black`;
                }
                else{
                    el.style.backgroundColor = `blue`;
                }
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
                $sql2 = "SELECT * FROM hasil";
                $row = $db->prepare($sql2);
                $row->execute();
                $hasil2 = $row->fetchAll();
                foreach ($hasil2 as $b) {
                    $rute = $b['hasil'];
                    $id_rute[] = explode(",",$rute);
                }

                foreach ($id_rute as $c) {
                    $jumlah_rute = count($c);
                    $id_user = $c[0];
                    
                    
                    
                ?>
                map_lokasi.addSource('<?= $id_user?>', {
                'type': 'geojson',
                'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                'type': 'LineString',
                'coordinates': [
                [<?php
                    $sql4 = "SELECT * FROM konsumen WHERE id_user = '$id_user'";
                    $row = $db->prepare($sql4);
                    $row->execute();
                    $hasil4 = $row->fetch();
                    $longitude_user = $hasil4['longitude'];
                    $latitude_user = $hasil4['latitude'];
                    echo $longitude_user.', '.$latitude_user;
                    ?>],
                <?php
                for($d = 1; $d<$jumlah_rute-1; $d++){
                    $id_vertex = $c[$d];
                    $sql3 = "SELECT * FROM vertex WHERE id = $id_vertex";
                    $row = $db->prepare($sql3);
                    $row->execute();
                    $hasil3 = $row->fetch();
                    $longitude_vertex_before = $hasil3['longitude'];
                    $latitude_vertex_before = $hasil3['latitude'];
                    
                ?>
                [<?= $longitude_vertex_before?>, <?= $latitude_vertex_before?>],
                <?php
                }
                ?>
                [<?php
                    $id_tambal = $c[$jumlah_rute-1];
                    $sql4 = "SELECT * FROM lokasi WHERE id_tambal = '$id_tambal'";
                    $row = $db->prepare($sql4);
                    $row->execute();
                    $hasil4 = $row->fetch();
                    $longitude_tambal = $hasil4['longitude'];
                    $latitude_tambal = $hasil4['latitude'];
                    echo $longitude_tambal.', '.$latitude_tambal;
                    ?>],
                ]
                }
                }
                });
                map_lokasi.addLayer({
                'id': '<?= $id_user?>',
                'type': 'line',
                'source': '<?= $id_user?>',
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
    </script>
        
    </body>
</html>
