<?php


// awal session
// tambahkan code ini disetiap page yang membutuhkan session login
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
// akhir session

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Selamat datang</h4>

    <!-- logout bisa dipindah ke navbar -->
    <a href="logout.php">Logout</a>
</body>
</html>