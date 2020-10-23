<?php include  "header.php";?>
    <!-- page content -->
<?php
if(!isset($_GET['did']))
{
    echo "<script>";
    echo 'window.location.href = "trips.php"';
    echo "</script>";
}
$did=$_GET['did'];
$dcn=mysqli_connect(Host,UN,PW,DBname);
$rsltrev=mysqli_query($dcn,"call driver_details('$did')");
$darr=mysqli_fetch_array($rsltrev);

?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#b3ada9;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <div class="col-md bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">تفاصيل السائق</h3>
                    <hr class="py-1">
                    <div class="input-group">
                        <input type="text"  class="form-control text-right" placeholder="أكتب أكتب أكتب " value="<?php echo $darr[1]?>" readonly aria-label="Search for...">
                        <div class="input-group-append ">
                            <span class="input-group-text" style="width:120px">اسم السائق</span>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text"  class="form-control text-right" placeholder="أكتب أكتب أكتب " value="<?php echo $darr[3]?>" readonly aria-label="Search for...">
                        <div class="input-group-append">
                            <span class="input-group-text" style="width:120px">رقم الحافلة</span>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text"  class="form-control text-right" placeholder="أكتب أكتب أكتب " value="<?php echo $darr[4]?>" readonly aria-label="Search for...">
                        <div class="input-group-append">
                            <span class="input-group-text" style="width:120px">لون الحافلة</span>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text"  class="form-control text-right" placeholder="أكتب أكتب أكتب "value="<?php echo $darr[5]?>" readonly aria-label="Search for...">
                        <div class="input-group-append">
                            <span class="input-group-text" style="width:120px">سّعة الحافلة</span>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text"  class="form-control text-right" placeholder="أكتب أكتب أكتب "value="<?php echo $darr[2]?>" readonly aria-label="Search for...">
                        <div class="input-group-append">
                            <span class="input-group-text" style="width:120px">جوال السائق</span>
                        </div>
                    </div>
                    <br>
                    <br>
                   

<?php if($darr[6]!='accepted') { ?>     <a  class="btn btn-danger" href="process/driver_des.php?tid=<?php echo $darr[0]?>&des=2" ID="Button1">رفض</a>
                    <a class="btn btn-success"  href="process/driver_des.php?tid=<?php echo $darr[0]?>&des=1" ID="Button1">قبول</a><?php }?>
                </div>

                <div class="col-md">

                </div>
            </div>






        </div>
    </div>


    <script>

    </script>


<?php include  "footer.php";?>