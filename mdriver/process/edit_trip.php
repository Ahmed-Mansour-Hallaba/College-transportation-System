<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["day_no"])and isset($_POST["bus"]) and isset($_POST["line"]) and $_POST['pid'])
{
    session_start();
    if($_SESSION['role']!='mdriver')
        header("location:../../index.php");
    $day_no = $_POST["day_no"];
    $bus = $_POST["bus"];
    $line = $_POST["line"];
    $pid=$_POST['pid'];
    if($day_no<1 or $line<1 or $bus<1)
    {
        $_SESSION["error"]=" حدث خطا بالتعيل ";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    $qry = mysqli_query($cn , "update  trips set day_no='$day_no', bus_id='$bus', line_id='$line' where id='$pid';");
    if (mysqli_error($cn)) {$_SESSION["error"]=" حدث خطا بالتعيل ";
    header('Location: ' . $_SERVER['HTTP_REFERER']);}
    else header('location:../trips.php');

}