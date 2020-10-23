<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["uid"])&&isset($_POST["mes"])&&isset($_POST["did"]))
{
    $uid=$_POST["uid"];
    $mid=$_POST["did"];
    $mes=$_POST["mes"];

    $uid=mysqli_real_escape_string($cn,$uid);
    $mid=mysqli_real_escape_string($cn,$mid);
    $mes=mysqli_real_escape_string($cn,$mes);
    $qry=mysqli_query($cn,"insert into feedback (message, ffrom, fto) values ('$mes','$uid','$mid')");

    if( mysqli_error($cn)) echo "<div class=\"alert alert-danger\" role=\"alert\">
حدث خطا برجاء المحاوله مره اخري
</div>";
    else echo "<div class=\"alert alert-success\" role=\"alert\">
  تم ارسال الشكوي بنجاح
</div>";
    // header("location:../index.php");
}