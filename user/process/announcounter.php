<?php

include "../../dbinfo.php";
$q=$_GET['q'];

$cn=mysqli_connect(Host,UN,PW,DBname);
$rslt=mysqli_query($cn,"select count(*) from user_notification where user_id=$q and is_opened=0");
if($rslt->num_rows==1)
{
    $arr = mysqli_fetch_array($rslt);
    if($arr[0]>0)
        echo "<span class=\"badge badge-danger badge-pill\">$arr[0]</span> ";
}
?>