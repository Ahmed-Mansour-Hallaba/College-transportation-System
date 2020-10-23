<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_GET["tid"])&&isset($_GET["des"])) {
    session_start();
    if($_SESSION['role']!='mdriver')
        header("location:../../index.php");
    $tid = $_GET["tid"];
    $des = $_GET["des"];
    if($des==1) {
        $qry = mysqli_query($cn, "update drivers set state='accepted' where id=$tid");
    }
    else if ($des==2)
        $qry = mysqli_query($cn, "update drivers set state='refused' where id=$tid");
    if (mysqli_error($cn)) echo mysqli_error($cn);
    else header("location:../index.php");
}