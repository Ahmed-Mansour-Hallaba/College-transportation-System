<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_GET["did"]))
{

    session_start();
    if($_SESSION['role']!='admin')
        header("location:../../index.php");
    $did = $_GET["did"];

    $ccn=mysqli_connect(Host,UN,PW,DBname);
    $ccq=mysqli_query($ccn,"select check_disrel($did)");
    $ccarr=mysqli_fetch_array($ccq);
    if($ccarr[0]=='1')
    mysqli_query($cn,"update districts set active='0' where id='$did'");
        else  mysqli_query($cn , "delete from  districts where id='$did';");
    if (mysqli_error($cn)) echo mysqli_error($cn);
    else header('Location:../districts.php ' );
}