<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["dist_name"]))
{
    session_start();
    if($_SESSION['role']!='admin')
        header("location:../../index.php");
    $dist_name = $_POST["dist_name"];

    $dist_name=mysqli_escape_string($cn,$dist_name);

    $qry = mysqli_query($cn , "insert into districts (name) values('$dist_name');");
    if (mysqli_error($cn)) echo mysqli_error($cn);
    else header('Location: ' . $_SERVER['HTTP_REFERER']);
}