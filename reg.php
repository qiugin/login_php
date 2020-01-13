<?php
session_start();
require 'koneksi.php';


function registrasi($data){
    global $conn;

    $nama = $data["nama"];
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    // cek email ada belum
    $result = mysqli_query($conn, "SELECT email FROM tb_user WHERE email = '$email'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('email sudah terdaftar');
            </script>";
            return false;
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('password tidak sesuai');
            </script>";
            return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO tb_user VALUES ('','$nama','$email','$password','') ");

    return mysqli_affected_rows($conn);
}



if (isset($_POST["register"])){
    if(registrasi($_POST) > 0){
        echo "<script>
                var txt;
                var r = confirm('Registrasi Berhasil !!!');
                if (r == true) {
                    window.location.replace('login.php');
                } else {
                    window.location.replace('login.php');
                }
            </script>";
    } else{
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Reg</title>
    <style>
        label{
            display:block;
        }
    </style>
    
</head>
<body>
    <h3>Registrasi</h3>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">nama : </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="email">email : </label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label for="password">password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Konfirmasi password : </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">Registrasi</button>
            </li>
        </ul>
    </form>
</body>
</html>