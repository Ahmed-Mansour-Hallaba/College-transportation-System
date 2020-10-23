<?php

    if(!isset($_POST['dat']))
    {
        echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
    }
    else {
        $d = $_POST['dat'];
        $d1 = (date('N', strtotime($d)) + 1) % 7;

        if ($d1 < 1 or $d1 > 5) {
            echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
        } else {

            include "../../dbinfo.php";
            $ucn=mysqli_connect(Host,UN,PW,DBname);
            $dcn=mysqli_connect(Host,UN,PW,DBname);
            $cn=mysqli_connect(Host,UN,PW,DBname);
            session_start();
            $uid=$_SESSION['uid'];
            $urslt=mysqli_query($ucn,"select fullname from users where id=$uid");
            $uarr=mysqli_fetch_array($urslt);
            $name=$uarr[0];
            $s="اعتذرت الطالبه $name ";
            $s.="عن الحضور في الرحله يوم $d";
            $drslt=mysqli_query($dcn,"select d.id from student_schedule ss join trips t on(ss.trip_id=t.id) join buses  b on (t.bus_id=b.id) join drivers d  on (d.bus_id=b.id) join users u on (ss.student_id=u.id) where t.day_no=$d1");
            mysqli_begin_transaction($cn);
            mysqli_query($cn,"insert into notifications(message) values ('$s')");
            $nid=mysqli_insert_id($cn);
            while ($darr=mysqli_fetch_array($drslt))
            {
                mysqli_query($cn,"insert into user_notification (user_id, notification_id, is_opened) values ('$darr[0]','$nid','0')");
            }
            if(mysqli_error($cn))
                echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
            else
            {
                mysqli_commit($cn);
                echo "    <div class=\"alert alert-success\" role=\"alert\">تم الاتعذار بنجاج </div>";
            }

        }
    }