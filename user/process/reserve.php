<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);

session_start();
$sid=$_SESSION['uid'];
mysqli_begin_transaction($cn);
$d=0;
mysqli_query($cn,"delete from student_schedule where student_id='$sid'");
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
         $_SESSION["error"]=" حدث خطا بالتسجيل ";
         header('Location: ' . $_SERVER['HTTP_REFERER']);
     }
 }
 mysqli_commit($cn);
 header("location:../schedule.php");
