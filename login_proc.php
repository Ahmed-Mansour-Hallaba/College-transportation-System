<?php
if (isset($_POST["un"])&&isset($_POST["pw"]))
{
    $un=$_POST["un"];
    $pw=$_POST["pw"];
    include "dbinfo.php";
    $cn=mysqli_connect(Host,UN,PW,DBname);
//select ifnull(check_login('MMans','1223'),'wrong')
    $rslt=mysqli_query($cn,"select ifnull(check_login('$un','$pw'),'wrong')");
    $arr=mysqli_fetch_array($rslt);
    if($arr[0]=='wrong')
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["error"]="اسم المستخدم او كلمه المرور غير صحيحه";
        //header("location:../index.php");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        /*if (isset($_POST["rem"]))
        {

            if ($_POST["rem"]=='on')
            {
                setcookie("usercookie",$un,time()+(86400 * 30),"/");
                setcookie("passcookie",$pw,time()+(86400 * 30),"/");
            }
        }*/
        $typ=$_POST['usertype'];
        if(($typ==1 and $arr[0]=='admin') or ($typ==2 and $arr[0]=='student') or ($typ==3 and $arr[0]=='driver') or ($typ==4 and $arr[0]=='mdriver')) {


            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            //session_start();
            $res1 = mysqli_query($cn, "select id from users where username='$un'");
            $arr1 = mysqli_fetch_array($res1);
            $_SESSION["uid"] = $arr1[0];
            $_SESSION["role"] = $arr[0];
            //header("location:../index.php");
            if($typ==1)
                header("location:admin");
            else if($typ==2)
                header("location:user");
            else if($typ==3)
            {
                $cnd=mysqli_connect(Host,UN,PW,DBname);
                $rsltd=mysqli_query($cnd,"select state from drivers where id=$arr1[0]");
                $arrd=mysqli_fetch_array($rsltd);
                if($arrd[0]=='accepted')
                    header("location:driver");
                else if($arrd[0]=='pending')
                {
                    session_unset();
                    $_SESSION["error"]="برجاء الانتظار لحين الموافقه علي اوراقك";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);

                }
                else if($arrd[0]=='refused')
                {
                    session_unset();
                    $_SESSION["error"]="عذرا لقد تم رفض ورقك";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }


            }
            else if($typ==4)
                header("location:mdriver");
        }
        else
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["error"]="اسم المستخدم او كلمه المرور غير صحيحه";
            //header("location:../index.php");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}

else  header("location:../index.php?error=inv");