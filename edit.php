<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    if(isset($_POST['edit'])){

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        // enkripsi password
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $data_email = $hasil['email'];

        $sql = "SELECT * FROM user WHERE id != $id AND email = '$email'";
        $row = $db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();

        if($email == $data_email){
        $stat = 1;
        }
        else{
            if(!empty($hasil)){
                $stat = 2;
            }
            else{
                $stat = 1;
            }
        }

        if($_POST["password"]==""){

            if($stat == 1){
                $data[] = $email;
                $data[] = $id;
                $sql = "UPDATE user SET email=? WHERE id=?";
                $stmt = $db->prepare($sql);

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($data);
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                if($saved){
                    header("Location: admin.php");
                }
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                $not = 1;
            }
            else{
                $not = 2;
                header("Location: edit.php?id=$id");
            }
        }
        else{
            if($stat == 1){
                $data[] = $email;
                $data[] = $password;
                $data[] = $id;
                $sql = "UPDATE user SET email=?, password=? WHERE id=?";
                $stmt = $db->prepare($sql);

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($data);
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                if($saved){
                    header("Location: admin.php");
                }
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                $not = 1;
            }
            else{
                $not = 2;
                header("Location: edit.php?id=$id");
            }
        }
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_edit.php';
    require 'foot.php';
}
?>