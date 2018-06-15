<?php

session_start();

$_SESSION = [];
session_destroy();

echo "<script>location.href='login.php';</script>";

?>
