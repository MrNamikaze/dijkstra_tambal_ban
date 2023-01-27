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
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
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
    	$namaFile = $_FILES['foto']['name'];
        $foto = explode(".",$namaFile);
        $namafoto = time().".".$foto[1];
        $namaSementara = $_FILES['foto']['tmp_name'];
        $gambar = $namafoto;
    	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if($_POST["password"]==""){
        	if($stat == 1){
        		if($gambar == ''){
        			$data[] = $email;
		            $data[] = $nama;
		            $data[] = $id;
		            $sql = "UPDATE user SET email=?, nama=? WHERE id=?";
		            $stmt = $db->prepare($sql);

		            // eksekusi query untuk menyimpan ke database
		            $saved = $stmt->execute($data);
		            session_destroy();
				    $sql = "SELECT * FROM user WHERE id=:id";
				    $stmt = $db->prepare($sql);
				    
				    // bind parameter ke query
				    $params = array(
				        ":id" => $id
				    );

				    $stmt->execute($params);

				    $user = $stmt->fetch(PDO::FETCH_ASSOC);
				    session_start();
				    $_SESSION["user"] = $user;
		            // jika query simpan berhasil, maka user sudah terdaftar
		            // maka alihkan ke halaman login
		            $not = 1;
        		}
        		else{
        			$data[] = $email;
		            $data[] = $nama;
		            $data[] = $gambar;
		            $data[] = $id;
		            $sql = "UPDATE user SET email=?, nama=?, gambar=? WHERE id=?";
		            $stmt = $db->prepare($sql);

		            // eksekusi query untuk menyimpan ke database
		            $saved = $stmt->execute($data);
		            $dirUpload = "img/";

					// pindahkan file
					$terupload = move_uploaded_file($namaSementara, $dirUpload.$namafoto);
				    session_destroy();
				    $sql = "SELECT * FROM user WHERE id=:id";
				    $stmt = $db->prepare($sql);
				    
				    // bind parameter ke query
				    $params = array(
				        ":id" => $id
				    );

				    $stmt->execute($params);

				    $user = $stmt->fetch(PDO::FETCH_ASSOC);
				    session_start();
				    $_SESSION["user"] = $user;
		            // jika query simpan berhasil, maka user sudah terdaftar
		            // maka alihkan ke halaman login
		            $not = 1;
        		}
        	}
        	else{
        		$not = 2;
        	}
            // menyiapkan query
            
        }
        else{
            // menyiapkan query
            if($stat == 1){
	            if($gambar == ''){
        			$data[] = $email;
		            $data[] = $nama;
		            $data[] = $password;
		            $data[] = $id;
		            $sql = "UPDATE user SET email=?, nama=?, password=? WHERE id=?";
		            $stmt = $db->prepare($sql);

		            // eksekusi query untuk menyimpan ke database
		            $saved = $stmt->execute($data);
		            session_destroy();
				    $sql = "SELECT * FROM user WHERE id=:id";
				    $stmt = $db->prepare($sql);
				    
				    // bind parameter ke query
				    $params = array(
				        ":id" => $id
				    );

				    $stmt->execute($params);

				    $user = $stmt->fetch(PDO::FETCH_ASSOC);
				    session_start();
				    $_SESSION["user"] = $user;
		            // jika query simpan berhasil, maka user sudah terdaftar
		            // maka alihkan ke halaman login
		            $not = 1;
        		}
        		else{
        			$data[] = $email;
		            $data[] = $nama;
		            $data[] = $gambar;
		            $data[] = $password;
		            $data[] = $id;
		            $sql = "UPDATE user SET email=?, nama=?, gambar=?, password=? WHERE id=?";
		            $stmt = $db->prepare($sql);

		            // eksekusi query untuk menyimpan ke database
		            $saved = $stmt->execute($data);
		            $dirUpload = "img/";

					// pindahkan file
					$terupload = move_uploaded_file($namaSementara, $dirUpload.$namafoto);
				    session_destroy();
				    $sql = "SELECT * FROM user WHERE id=:id";
				    $stmt = $db->prepare($sql);
				    
				    // bind parameter ke query
				    $params = array(
				        ":id" => $id
				    );

				    $stmt->execute($params);

				    $user = $stmt->fetch(PDO::FETCH_ASSOC);
				    session_start();
				    $_SESSION["user"] = $user;
		            // jika query simpan berhasil, maka user sudah terdaftar
		            // maka alihkan ke halaman login
		            $not = 1;
        		}
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