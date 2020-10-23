<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["uid"])&&isset($_POST["mes"]))
{
    $uid=$_POST["uid"];
    $mes=$_POST["mes"];
    $uid=mysqli_real_escape_string($cn,$uid);
    $mes=mysqli_real_escape_string($cn,$mes);
    $qry=mysqli_query($cn,"insert into suggestions (mess, uid) values ('$mes','$uid')");

    if( mysqli_error($cn)) echo "<div class=\"alert alert-danger\" role=\"alert\">
حدث خطا برجاء المحاوله مره اخري
</div>";
    else echo "<div class=\"alert alert-success\" role=\"alert\">
  تم ارسال الاقتراح بنجاح
</div>";
    // header("location:../index.php");
}