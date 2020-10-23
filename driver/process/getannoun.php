<?php

include "../../dbinfo.php";
$q=$_GET['q'];

$cn=mysqli_connect(Host,UN,PW,DBname);
$cn1=mysqli_connect(Host,UN,PW,DBname);
$rslt=mysqli_query($cn,"call userannouncement($q)");

if($rslt->num_rows!=null)
    {
    while ($arr = mysqli_fetch_array($rslt)) {
        $cont=$arr[1];
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        if ($arr[2] == 1)
            echo '<i class="fas fa-envelope-open text-success mr-3"></i>';
        else echo '<i class="fas fa-envelope text-danger mr-3"></i>';
        echo $cont."</li>" ;
    }
}
else echo 'لا يوجد اشعارات';

mysqli_query($cn1,"update user_notification set is_opened=1 where user_id='$q'");
?>