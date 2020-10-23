<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
$cn1=mysqli_connect(Host,UN,PW,DBname);

session_start();
$sid=$_SESSION['uid'];
mysqli_begin_transaction($cn);
$d=0;
$t=0;
mysqli_query($cn,"delete from student_schedule where student_id='$sid'");
$crslt=mysqli_query($cn1, "select count_trips($sid);");

$cc=mysqli_fetch_array($crslt);
 for($i=1;$i<6;$i++)
 {
     $from=$_POST['from_'.$i];
     $to=$_POST['to_'.$i];
     $check='off';
    if(isset($_POST['check_'.$i])) $check=$_POST['check_'.$i];
    if($check=='on')
    {
        mysqli_query($cn,"insert into student_schedule (trip_id, student_id) values ('$from','$sid')");
        mysqli_query($cn,"insert into student_schedule (trip_id, student_id) values ('$to','$sid')");
        $d++;
    }
     if (mysqli_error($cn)) {

         mysqli_rollback($cn);
         echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا بالتسجيل </div>";
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
         $t=1;
     }

 }
if (mysqli_error($cn)) {

    mysqli_rollback($cn);
    echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا بالتسجيل </div>";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if ($t==0){


    mysqli_commit($cn);
    $s=random_int(100000,999999);
    $pr=$d*80;
    mysqli_query($cn,"insert into user_code (user_id,cod) values ('$sid','$s')");
if($cc[0]>0)
{
    $dc=$cc[0]/2;
    if($dc==$d)
    {
        echo " <div class=\"alert alert-success\" role=\"alert\"> 
 تم تعديل الجدول بنجاح
 </div>";
    }
    else if($dc<$d)
    {
        $pr-=($dc*80);
        echo " <div class=\"alert alert-success\" role=\"alert\"> 
 تم تعديل الجدول بنجاح  <br>
برجاء سداد مبلغ $pr ريال
<br> كود الدفع $s
 </div>";
    }
    else if($dc>$d)
    {
        $pr-=($dc*80);
        $pr*=-1;
        echo " <div class=\"alert alert-success\" role=\"alert\"> 
 تم تعديل الجدول بنجاح  <br>
لديكي مبلغ مستحق قيمته $pr ريال
<br> كود الاسترجاع $s
 </div>";
    }
}
else
    echo " <div class=\"alert alert-success\" role=\"alert\"> 
 تم التسجيل بنجاح  <br>
برجاء سداد مبلغ $pr ريال
<br> كود الدفع $s
 </div>";



}

