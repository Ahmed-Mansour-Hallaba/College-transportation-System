<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if(isset($_POST["pname"])&&isset($_POST['districtcount']))
{
    $dcount=$_POST['districtcount'];
    $dir=$_POST['dir'];
    $col_time=$_POST['col_time'];
    if($dir==1)
        $dir='to';
    else if($dir==2)
        $dir='from';
    session_start();

    if($dcount<1)
    {
        $_SESSION["error"]=" حدث خطا بالتسجيل ";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
    for($i=1;$i<=$dcount;$i++)
    {
        if(!isset($_POST['districtcombo_'.$i])or !isset($_POST['districttime_'.$i]))
        {
            $_SESSION["error"]=" حدث خطا بالتسجيل ";

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    mysqli_begin_transaction($cn);
    if($_SESSION['role']!='admin')
        header("location:../../index.php");
    $pname = $_POST["pname"];
    $pname=mysqli_escape_string($cn,$pname);

     mysqli_query($cn , "insert into bus_lines (line_name,direction,coll_time) values('$pname','$dir','$col_time');");
    if (mysqli_error($cn)) {
        $_SESSION["error"]=" حدث خطا بالتسجيل ";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }


    $last_id =mysqli_insert_id($cn);
    for($i=1;$i<=$dcount;$i++)
    {
        $dtime=$_POST['districttime_'.$i];
        $did=$_POST['districtcombo_'.$i];
        mysqli_query($cn , "insert into line_details (line_id, district_time, district_id) values('$last_id','$dtime',$did);");
    }
    if (mysqli_error($cn)) {

        mysqli_rollback($cn);
    //    mysqli_query($cn,"delete from bus_lines where id='$last_id'");
        $_SESSION["error"]=" حدث خطا بالتسجيل ";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
    mysqli_commit($cn);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}