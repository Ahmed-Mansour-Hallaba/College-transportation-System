<?php

    if(!isset($_POST['execuse'])or !isset($_POST['bno'])or !isset($_POST['color'])or !isset($_POST['dname']))
    {
        echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
    }
    else {
        /*
        $d = $_POST['dat'];
        $d1 = (date('N', strtotime($d)) + 1) % 7;
        */
        $exec=$_POST['execuse'];
        $bno=$_POST['bno'];
        $color=$_POST['color'];
        $dname=$_POST['dname'];

       /* if ($d1 < 1 or $d1 > 5) {
            echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
        } else {
*/
            include "../../dbinfo.php";
            $ucn=mysqli_connect(Host,UN,PW,DBname);
            $dcn=mysqli_connect(Host,UN,PW,DBname);
            $acn=mysqli_connect(Host,UN,PW,DBname);
            $cn=mysqli_connect(Host,UN,PW,DBname);

            $urslt=mysqli_query($ucn,"select driver_id,execuse_date from execuses where id=$exec");
            $uarr=mysqli_fetch_array($urslt);
            $did=$uarr[0];
            $d=$uarr[1];
            $d1 = (date('N', strtotime($d)) + 1) % 7;
            $drslt=mysqli_query($dcn,"select t.id from trips t join drivers d on(t.bus_id=d.bus_id) where d.id='$did' and t.day_no='$d1'");
            $s=" نعتذر سيبدل السائق في رحلات يوم  $d ";
            $s.="بسائق اخر اسمه $dname ";
            $s.="و رقم لوحه الحافله $bno ";
            $s.="و لون الحافه $color ";
        mysqli_begin_transaction($cn);
        mysqli_query($cn,"insert into notifications(message) values ('$s')");
        $nid=mysqli_insert_id($cn);

        while ($darr=mysqli_fetch_array($drslt))
            {
                $tid=$darr[0];
                $arslt=mysqli_query($acn,"select student_id from student_schedule where trip_id='$tid'");
                while ($aarr=mysqli_fetch_array($arslt))
                {
                    mysqli_query($cn,"insert into user_notification (user_id, notification_id, is_opened) values ('$aarr[0]','$nid','0')");
                }
            }
        mysqli_query($cn,"update execuses set solved=1 where id=$exec ");



            if(mysqli_error($cn)) {
                mysqli_rollback($cn);
                echo "    <div class=\"alert alert-danger\" role=\"alert\">حدث خطا برجاء المحاوله مره اخري </div>";
            }
            else
            {
                mysqli_commit($cn);
                echo "    <div class=\"alert alert-success\" role=\"alert\">تم الاعتذار بنجاج </div>";
            }

        //}
    }