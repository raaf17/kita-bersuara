<?php
session_start();
//hancurkan 
session_destroy();

echo "<script>alert('Anda Telah Logout');</script>";
echo "<script>location='index.php';</script>";
?>