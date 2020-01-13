<?php 
session_start();
require 'koneksi.php';


// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['wadu']) ){
    $id = $_COOKIE['id'];
    $wadu = $_COOKIE['wadu'];

    // ambil email berdasarkan id
    $result = mysqli_query($conn,"SELECT email FROM tb_user WHERE id_admin=$id");

    $row = mysqli_fetch_assoc($result);

    // cek cookie dan email
    if( $wadu === hash('sha256', $row['email'])){
        $_SESSION['login'] = true;
    }

}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}




if(isset($_POST["login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");

    // cek email
    if( mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        
        // kebalikan password_hash
        if(password_verify($password, $row["password"])){
            // buat session
            $_SESSION["login"] = true;

            // cek ingat saya
            if( isset($_POST['ingat'])){
                // buat cookie dengan masa berlaku cookie 1 menit (60 detik)
                setcookie('id', $row['id_admin'], time()+60);
                setcookie('wadu', hash('sha256', $row['email']),time()+60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <h4>LOGIN</h4>

    <form action="" method="post">
        <ul>
            <li>
                <label for="email">Email : </label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="ingat" id="ingat">
                <label for="ingat">Ingat Saya</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

    <a href="reg.php">Registrasi</a>


    <?php if(isset($error)) : ?>
    <p class="salah">Email/Password Salah</p>
    <?php endif; ?>
</body>
</html>