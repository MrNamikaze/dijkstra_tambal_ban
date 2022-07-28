<?php
require_once("koneksi.php");
$sql = "SELECT * FROM produk WHERE id_kategori = 0";
$row = $db->prepare($sql);
$row->execute();
$produk = $row->fetchAll();
?>

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style type="text/css">
            section.produk{
                background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("img/1234.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: scroll;
                background-size: cover;
            }
            div.produk{
                background-image: url("img/1234.jpg");
                background-color: #cccccc;
            }
            div.garis {
            border-left: 6px solid black;
            height: 200px;
            position:absolute;
            left: 50%;
            }
        </style>>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php
        include('navbar_index.php');
        ?>
        <!-- About-->
        <section class="page-section produk" id="services">

            <div class="container px-4 px-lg-5">
                <h2>Daftar Paket & Additional</h2>
                <br>
                <div class="row justify-content-start">
                    <?php
                    $jumlah = count($produk);
                    for($b=0;$b<$jumlah;$b++){
                        $nama1 = $produk[$b]['id'];
                        $sql2 = "SELECT * FROM produk WHERE id_kategori = $nama1";
                        $row = $db->prepare($sql2);
                        $row->execute();
                        $detail_1 = $row->fetchAll();
                        $kategori = str_replace(" ","_",$produk[$b]['kategori']);
                    ?>
                    <div class="col-sm-4" style="border:1px solid black;">
                        <h5><b style="color: white;"><?= $produk[$b]['nama']?></b></h5>
                        <a href="kategori.php?kategori=<?= $kategori?>"><h5><b style="color: blue;"><?= $produk[$b]['kategori']?></b></h5></a>
                        <br>
                        <?php
                            foreach ($detail_1 as $a) {
                        ?>
                        <p><?php echo '<b style="color: white;">'.$a['nama'].'</b>';
                        }
                        ?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">ADDITIONAL</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Lorong masuk 2x4 bunga plastik</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">1.500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Lorong masuk 2x4 fresh flowers </h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">2.500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Porgola 4x4 bunga plastik</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">2.500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Porgola 6x6 bunga plastik</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">5.000.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Beam lighting (min 4pcs)</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">1.500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Kipas dengan embun air</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">375.000/pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Kipas tornado</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">150.000/pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Lorong masuk 2x4 bunga plastik</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">1.500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Lampu bunga </h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">250.000/2pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Kotak angpao</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">150.000/pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Meja 1pcs + kursi akad 6pcs</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">300.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Papan wedding akrilik</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">250.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Firework</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">500.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Stand foto</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">100.000</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Kursi plastik + cover</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">6.000/pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">karpet baru</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">25.000/M</h3>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-9 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2" style="text-align: left;">Karpet </h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">10.000/M</h3>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <h2 class="text-center mt-0">Note</h2>
                <br>
                <h3><span style="height: 25px;width: 25px;background-color: #bbb;border-radius: 50%;display: inline-block;"></span>&nbsp; Lokasi acara lebih dari 10km, terkena biaya transportasi sesuai jarak</h3>
                <br>
                <h3><span style="height: 25px;width: 25px;background-color: #bbb;border-radius: 50%;display: inline-block;"></span>&nbsp;Jika item free tidak digunakan tidak mengurangi biaya sewa ataupun diganti dengan item lainnya</h3>
            </div>
            <br>
            <center>
                <div id="demo" class="carousel slide" data-ride="carousel">

                  <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                  </ul>
                  
                  <!-- The slideshow -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="img/additional.jpg" alt="Los Angeles" width="1100" height="500">
                    </div>
                    <div class="carousel-item">
                      <img src="img/additional2.jpg" alt="Chicago" width="1100" height="500">
                    </div>
                  </div>
                  
                  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </a>
                </div>
            </center>
        </section>
        <footer class="bg-light py-5">
        </footer>
        <!-- Bootstrap core JS-->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        
    </body>
</html>
