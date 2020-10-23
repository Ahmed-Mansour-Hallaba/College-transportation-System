<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
if($_POST["usertype"]==2&&isset($_POST["uname"])&&isset($_POST["pass"])&&isset($_POST["fname"])&&isset($_POST["mob"])&&isset($_POST["adr"])&&isset($_POST["pmob"]))
{
    $fname=$_POST["fname"];
    $pw=$_POST["pass"];
    $uname=$_POST["uname"];
    $mob=$_POST["mob"];
    $pmob=$_POST["pmob"];
    $address=$_POST["adr"];
    $dist=$_POST['did'];
    $uname=mysqli_real_escape_string($cn,$uname);
    $pw=mysqli_real_escape_string($cn,$pw);
    $fname=mysqli_real_escape_string($cn,$fname);
    $mob=mysqli_real_escape_string($cn,$mob);
    $address=mysqli_real_escape_string($cn,$address);

    if ($_FILES["img"]["size"] >0 )
    {
        $img_name ="../../uimg/$uname" . date("Ymdhis").".".pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION  );
        $img_name1 ="../uimg/$uname" . date("Ymdhis").".".pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION  );
        move_uploaded_file($_FILES["img"]["tmp_name"] , $img_name);
        mysqli_query($cn,"insert into users(fullname, username, pass, role) values ('$fname','$uname','$pw','student')");
        $sid=mysqli_insert_id($cn);
        mysqli_query($cn , "insert into students(id, mobile, parent_mobile, address, img, district_id) values ('$sid','$mob','$pmob','$address','$img_name1','$dist')");
        echo mysqli_error($cn);
    }
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else
    {
        session_start();
        $_SESSION["uid"] = $sid;
        $_SESSION["role"] = 'student';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


}
else if($_POST["usertype"]==1&&isset($_POST["uname"])&&isset($_POST["pass"])&&isset($_POST["fname"])&&isset($_POST["mob"])&&isset($_POST["busnumber"])&&isset($_POST["color"])&& isset($_POST['cap']))
{

    $fname=$_POST["fname"];
    $pw=$_POST["pass"];
    $uname=$_POST["uname"];
    $mob=$_POST["mob"];
    $bnum=$_POST["busnumber"];
    $color=$_POST["color"];
    $cap=$_POST["cap"];
    $uname=mysqli_real_escape_string($cn,$uname);
    $pw=mysqli_real_escape_string($cn,$pw);
    $fname=mysqli_real_escape_string($cn,$fname);
    $mob=mysqli_real_escape_string($cn,$mob);
    mysqli_query($cn,"call regist_driver('$fname','$uname','$pw','$mob','$bnum','$color','$cap')");

    if(mysqli_error($cn)) echo mysqli_error($cn);
    else header("location:../../index.php");

}
else echo  header("location:../index.php?error=invalid");