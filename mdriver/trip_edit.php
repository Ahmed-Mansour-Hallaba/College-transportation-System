<?php include  "header.php";?>
    <!-- page content -->
<?php
if(!isset($_GET['tid']))
{
    echo "<script>";
    echo 'window.location.href = "trips.php"';
    echo "</script>";
}
$pid=$_GET['tid'];
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$brslt=mysqli_query($dcn,"select * from buses");
$blrslt=mysqli_query($pcn,"select * from bus_lines");
$trslt=mysqli_query($pcn,"select * from trips where id=$pid");
$tarr=mysqli_fetch_array($trslt);
$days=array('*','الاحد','الاثنين',"الثلاثاء","الاربعاء","الخميس");
?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#2a81c9;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <div class="col-md bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold text-warning">أسم الفورمة </h3>
                    <hr class="py-1">

                    <form method="post" action="process/edit_trip.php">
                        <?php include "../view_error.php"; ?>
                        <input type="hidden" name="pid" value="<?php echo $tarr[0];?>">
                        <div class="input-group">
                            <select name="day_no" class="btn btn-secondary w-100 my-1" >
                                <option value="-1">اختر يوم الاسبوع</option>
                                <?php
                                for($i=1;$i<6;$i++) {
                                    echo " <option value=\"$i\"";
                                    if ($i == $tarr[1]) echo 'selected';
                                    echo ">$days[$i]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <select name="bus" class="btn btn-secondary w-100 my-1">
                                <option value="-1">اختر رقم الحافله</option>
                                <?php while ($arr=mysqli_fetch_array($brslt))
                                {
                                    echo " <option value=\"$arr[0]\"";
                                    if($arr[0]==$tarr[2]) echo 'selected';
                                    echo ">$arr[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <select name="line" class="btn btn-secondary w-100 my-1">
                                <option value="-1">اختر مسار الرحله</option>
                                <?php while ($arr=mysqli_fetch_array($blrslt))
                                {
                                    echo " <option value=\"$arr[0]\"";
                                    if($arr[0]==$tarr[3]) echo 'selected';

                                    echo">$arr[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-success" onclick="submit()" ID="Button1">عدل الرحله</button>
                    </form>


                </div>

                <div class="col-md">

                </div>
            </div>






        </div>
    </div>


    <script>

    </script>


<?php include  "footer.php";?>