<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["day_no"])and isset($_POST["bus"]) and isset($_POST["line"]))
{
    session_start();
    if($_SESSION['role']!='admin')
        header("location:../../index.php");
    $day_no = $_POST["day_no"];
    $bus = $_POST["bus"];
    $line = $_POST["line"];
    if($day_no<1 or $line<1 or $bus<1)
    {
        $_SESSION["error"]=" حدث خطا بالتسجيل ";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    $qry = mysqli_query($cn , "insert into trips (day_no, bus_id, line_id) values('$day_no','$bus','$line');");
    if (mysqli_error($cn)) echo mysqli_error($cn);
    else header('Location: ' . $_SERVER['HTTP_REFERER']);
}