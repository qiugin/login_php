<?php 
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'myhotel';
	$conn = mysqli_connect($server,$user,$pass,$db);
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}