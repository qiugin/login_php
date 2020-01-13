<?php
// menghapus session
session_start();
session_unset();
session_destroy();

// menghapus cookie
setcookie('id','',time() - 4000);
setcookie('wadu','',time() - 4000);

header("Location: login.php");
exit;
?>