<?php
session_start();
session_destroy(); 
unset($_COOKIE['csrf_token']);
header('Location: login.php');
?>