<?php
require_once("koneksi.php");
if(isset($_POST['register'])){
        $namaFile = $_FILES['foto']['name'];
        $foto = explode(".",$namaFile);
        $namafoto = time().".".$foto[1];
        $namaSementara = $_FILES['foto']['tmp_name'];
                // filter data yang diinputkan
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $gambar = $namafoto;

        if($namaFile==''){
            $usr = 3;
        }
        else{
            $random = rand(10000000,99999999);
            // menyiapkan query
            $sql = "INSERT INTO user (email, nama, gambar, password, role, id_tambal) 
                    VALUES (:email, :nama, :gambar, :password, :role, :id_tambal)";
            $stmt = $db->prepare($sql);

            // bind parameter ke query
            $params = array(
                ":email" => $email,
                ":nama" => $nama,
                ":gambar" => $gambar,
                ":password" => $password,
                ":role" => 2,
                ":id_tambal" => 'a'.$random,
            );

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($params);
            //
            $sql2 = "INSERT INTO lokasi (id_tambal, nama, alamat, longitude, latitude) 
                        VALUES (:id_tambal, :nama, :alamat, :longitude, :latitude)";
            $stmt = $db->prepare($sql2);

            // bind parameter ke query
            $params = array(
                ":id_tambal" => 'a'.$random,
                ":nama" => $nama,
                ":alamat" => 'isi',
                ":longitude" => 0,
                ":latitude" => 0,
            );

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($params);
            //
            $dirUpload = "img/";

            // pindahkan file
            $terupload = move_uploaded_file($namaSementara, $dirUpload.$namafoto);
            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved){
                header("Location: index.php");
            }
            else{
                $usr = 2;
            }
        }
    }
?>