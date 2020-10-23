<?php include  "header.php";?>
    <!-- page content -->
<?php
    $ccn=mysqli_connect(Host,UN,PW,DBname);
    $pcn=mysqli_connect(Host,UN,PW,DBname);
    $crslt=mysqli_query($ccn, "select check_schedule($login);");
    $carr=mysqli_fetch_array($crslt);
    if($login<1)
    {
        echo "<script>";
        echo 'window.location.href = "index.php"';
        echo "</script>";
    }

    if($carr[0]=='0')
    {
        echo "<script>";
        echo 'window.location.href = "reservation.php"';
        echo "</script>";
    }
$days=array('*','الاحد','الاثنين',"الثلاثاء","الاربعاء","الخميس");
$trslt=mysqli_query($pcn,"call get_user_schedule($login)");

?>
    <style>
        thead,tbody,tfoot,tr,td{
            width:100% !important;
            white-space:nowrap;

        }
    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-right " style="position:relative;">
            <div class="row px-2">
                <div class="col-12 bg-light text-warning text-right rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">جدول رحلاتي</h3>
                    <hr class="py-1">
                    <a href="apologize.php" class="btn btn-danger">الاعتذار</a>
                    <a href="reservation.php" class="btn btn-warning">تعديل الجدول</a>

                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>التفاصيل</th>
                            <th>يوم الرحله</th>
                            <th>رقم الحافله</th>
                            <th>لون الحافله</th>
                            <th>الاتجاه</th>
                            <th>وقت الكليه</th>
                            <th>وقت للمنزل</th>
                            <th>رقم الرحله</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($arr=mysqli_fetch_array($trslt))
                        {
                            if($arr[4]=='to')
                                $dir='الي الكليه';
                            else $dir='من الكليه';
                            ?>
                            <tr>
                                <td><a href="trip_details.php?tid=<?php echo $arr[0]?>">التفاصيل</a></td>
                                <td><?php echo $days[$arr[1]]?></td>
                                <td><?php echo $arr[2]?></td>
                                <td><?php echo $arr[3]?></td>
                                <td><?php echo $dir?></td>
                                <td><?php echo $arr[5]?></td>
                                <td><?php echo $arr[6]?></td>
                                <td><?php echo $arr[0]?></td>
                            </tr>
                        <?php }?>
                    </table>

                </div>
            </div>
        </div>
    </div>


<?php include  "footer.php";?>