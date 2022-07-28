<?php
session_start();
$not = 0;
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

    $data_email = $_SESSION['user']['email'];
	$sql = "SELECT * FROM user WHERE id != $id AND email = '$email'";
	$row = $db->prepare($sql);
	$row->execute();
	$hasil = $row->fetchAll();

	if($email == $data_email){
	$stat = 1;
	}
	else{
		if(!empty($hasil) && !empty($hasil1)){
			$stat = 2;
		}
		if(empty($hasil) && empty($hasil1)){
			$stat = 1;
		}
		else{
			$stat = 3;
		}
	}

    if(isset($_POST['profile'])){
    	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

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
	            $not = 1;
        	}
        	else{
        		$not = 2;
        	}
            // menyiapkan query
            
        }
        else{
            // menyiapkan query
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
	            $not = 1;
            }
            else{
            	$not = 2;
            }
        }
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_profile_master.php';
    require 'foot.php';
}
?>