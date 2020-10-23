<?php include  "header.php";?>
    <!-- page content -->
<?php
if(!isset($_GET['tid']))
{
    echo "<script>";
    echo 'window.location.href = "trips.php"';
    echo "</script>";
}
$tid=$_GET['tid'];
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$trslt=mysqli_query($dcn,"select day_no,busnumber,line_name,direction,coll_time,line_id from trips t join buses b on (b.id=t.bus_id) join bus_lines ld on(ld.id=t.line_id) where t.id='$tid'");
$trr=mysqli_fetch_array($trslt);
if($trr[3]=='from')
    $dir="من الكليه";
else $dir="الي الكليه";
$lrslt=mysqli_query($pcn,"select district_time,name from line_details ld join districts d on(d.id=ld.district_id) where line_id=$trr[5]");
$days=array('*','الاحد','الاثنين',"الثلاثاء","الاربعاء","الخميس");
?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <div class="col-md-6 bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">تفاصيل مسار الرحله </h3>
                    <hr class="py-1">
                    <div class="text-dark text-right font-weight-bold">
                    <label class="form-check-label"><?php echo $trr[2]?></label>
                    <label class="form-check-label w-25 py-1">:اسم المسار</label> <br>
                    <label class="form-check-label"><?php echo $trr[1]?></label>
                    <label class="form-check-label w-25 py-1">:رقم الباص</label> <br>
                    <label class="form-check-label"><?php echo $days[$trr[0]]?></label>
                    <label class="form-check-label w-25 py-1">:يوم الرحله</label> <br>
                    <label class="form-check-label"><?php echo $dir ?></label>
                    <label class="form-check-label w-25 py-1">:الاتجاه</label> <br>
                    <label class="form-check-label"><?php echo $trr[4] ?></label>
                    <label class="form-check-label w-30 py-1">:وقت التواجد في الكليه</label> <br>
                    <?php
                    $cnt=1;
                    while ($arr=mysqli_fetch_array($lrslt))
                    {
                        ?>
                    <label class="form-check-label"><?php echo $arr[0]?></label>
                    <label class="form-check-label">وقت الوصول</label>
                    <label class="form-check-label"><?php echo $arr[1]?></label>

                    <label class="form-check-label w-25 py-1">:الحي <?php echo $cnt?></label><br>
                    <?php
                    $cnt++;
                    }?>
                    </div>
                </div>

                <div class="col-md">

                </div>
            </div>






        </div>
    </div>


<?php include  "footer.php";?>