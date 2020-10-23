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
            $s="اعتذرت السائق $name ";
            $s.="عن الحضور في الرحله يوم $d";
            $drslt=mysqli_query($dcn,"select id from users where role='mdriver'");
            mysqli_begin_transaction($cn);
            mysqli_query($cn,"insert into execuses(driver_id, execuse_date) values ('$uid','$d')");
            mysqli_query($cn,"insert into notifications(message) values ('$s')");
            $nid=mysqli_insert_id($cn);
            while ($darr=mysqli_fetch_array($drslt))
            {
                mysqli_query($cn,"insert into user_notification (user_id, notification_id, is_opened) values ('$darr[0]','$nid','0')");
            }
            if(mysqli_error($cn)) {
                mysqli_rollback($cn);
                echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
            }
            else
            {
                mysqli_commit($cn);
                echo "    <div class=\"alert alert-success\" role=\"alert\">تم الاعتذار بنجاج </div>";
            }

        }
    }