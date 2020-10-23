<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["dist_name"])and isset($_POST['did']))
{
    session_start();
    if($_SESSION['role']!='admin')
        header("location:../../index.php");
    $dist_name = $_POST["dist_name"];
    $did = $_POST["did"];

    $dist_name=mysqli_escape_string($cn,$dist_name);

    $qry = mysqli_query($cn , "update  districts set name='$dist_name' where id='$did';");
    if (mysqli_error($cn)) echo mysqli_error($cn);
    else header('Location:../districts.php ' );
}