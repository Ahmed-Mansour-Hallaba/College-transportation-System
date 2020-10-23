<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['role']=='driver')
    $auth=true;
else $auth=false;
if($auth!=true) {
    echo "<script>";
    echo 'window.location.href = "../index.php"';
    echo "</script>";
}