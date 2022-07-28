<?php
require_once("koneksi.php");
$sql2 = "SELECT * FROM rating";
$row = $db->prepare($sql2);
$row->execute();
$produk2 = $row->fetchAll();

$status = 0;
if(isset($_POST['register'])){

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $no_wa = filter_input(INPUT_POST, 'no_wa', FILTER_SANITIZE_STRING);
    $ulasan = filter_input(INPUT_POST, 'ulasan', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM history WHERE no_wa = '$no_wa'";
    $row = $db->prepare($sql);
    $row->execute();
    $produk = $row->fetchAll();
    if(empty($produk)){
        $status = 2;
    }
    else{
        $sql = "INSERT INTO rating (nama, no_wa, ulasan, rating) 
                        VALUES (:nama, :no_wa, :ulasan, :rating)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":nama" => $nama,
            ":no_wa" => $no_wa,
            ":ulasan" => $ulasan,
            ":rating" => $rating,
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            $status = 1;
            header("Location: rating.php");
        }
        else{
            $status = 2;
        }
    }
}
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            
            .rating {
              --dir: right;
              --fill: gold;
              --fillbg: rgba(100, 100, 100, 0.15);
              --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
              --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
              --stars: 5;
              --starsize: 3rem;
              --symbol: var(--star);
              --value: 1;
              --w: calc(var(--stars) * var(--starsize));
              --x: calc(100% * (var(--value) / var(--stars)));
              block-size: var(--starsize);
              inline-size: var(--w);
              position: relative;
              touch-action: manipulation;
              -webkit-appearance: none;
            }
            [dir="rtl"] .rating {
              --dir: left;
            }
            .rating::-moz-range-track {
              background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
              block-size: 100%;
              mask: repeat left center/var(--starsize) var(--symbol);
            }
            .rating::-webkit-slider-runnable-track {
              background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
              block-size: 100%;
              mask: repeat left center/var(--starsize) var(--symbol);
              -webkit-mask: repeat left center/var(--starsize) var(--symbol);
            }
            .rating::-moz-range-thumb {
              height: var(--starsize);
              opacity: 0;
              width: var(--starsize);
            }
            .rating::-webkit-slider-thumb {
              height: var(--starsize);
              opacity: 0;
              width: var(--starsize);
              -webkit-appearance: none;
            }
            .rating, .rating-label {
              display: block;
              font-family: ui-sans-serif, system-ui, sans-serif;
            }
            .rating-label {
              margin-block-end: 1rem;
            }

            /* NO JS */
            .rating--nojs::-moz-range-track {
              background: var(--fillbg);
            }
            .rating--nojs::-moz-range-progress {
              background: var(--fill);
              block-size: 100%;
              mask: repeat left center/var(--starsize) var(--star);
            }
            .rating--nojs::-webkit-slider-runnable-track {
              background: var(--fillbg);
            }
            .rating--nojs::-webkit-slider-thumb {
              background-color: var(--fill);
              box-shadow: calc(0rem - var(--w)) 0 0 var(--w) var(--fill);
              opacity: 1;
              width: 1px;
            }
            [dir="rtl"] .rating--nojs::-webkit-slider-thumb {
              box-shadow: var(--w) 0 0 var(--w) var(--fill);
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php
        include('navbar_index.php');
        ?>
        <!-- About-->
        <section class="page-section" id="services">

            <div class="container px-4 px-lg-5">
                <h2>Rating & Ulasan</h2>
                <br>
                <?php if($status == 1):?>
                    <div class="alert alert-success" role="alert">
                      Ulasan berhasil ditambahkan!
                    </div>
                <?php endif?>
                <?php if($status == 2):?>
                    <div class="alert alert-danger" role="alert">
                      Error!
                    </div>
                <?php endif?>  
                <div class="row justify-content-start">
                    <form class="user" action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" 
                            placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa" 
                            placeholder="No Whatsapp">
                    </div>
                    <div class="form-group">
                        <textarea name="ulasan" style="width: 100%"></textarea>
                    </div>
                    <div class="form-group">
                          <input
                            class="rating"
                            max="5"
                            oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"
                            step="1"
                            style="--stars:5;--value:3"
                            type="range"
                            value="3"
                            name="rating">
                        </label>
                    </div>
                    <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Tambah!!">
                    </form>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container px-4 px-lg-5">
                <table class="table table-dark" style="width: 100%">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Ulasan</th>
                      <th scope="col">Rating</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $c = 1;
                    foreach($produk2 as $b):
                    ?>
                    <tr>
                      <th scope="row"><?= $c;?></th>
                      <td><?= $b['nama'];?></td>
                      <td><?= $b['ulasan'];?></td>
                      <td><?php
                      $nilai = $b['rating'];
                      for($d=1;$d<=$nilai;$d++):
                      ?>
                      <span class="fa fa-star checked" style="color: yellow"></span>
                      <?php
                      endfor;
                      ?>
                      </td>
                    </tr>
                    <?php $c++;endforeach;?>
                  </tbody>
                </table>
            </div>
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
