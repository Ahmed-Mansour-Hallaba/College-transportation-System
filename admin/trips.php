<?php include  "header.php";?>
    <!-- page content -->

<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$brslt=mysqli_query($dcn,"select * from buses");
$blrslt=mysqli_query($pcn,"select * from bus_lines");
$trslt=mysqli_query($pcn,"select t.id,day_no,busnumber,line_name from trips t join buses b on(b.id=t.bus_id) join bus_lines bl on (bl.id=t.line_id)");
$days=array('*','الاحد','الاثنين',"الثلاثاء","الاربعاء","الخميس");
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


                <div class="col-12 bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">تسجيل رحله جديده </h3>
                    <hr class="py-1">


                    <form method="post" action="process/add_trip.php">
                        <?php include "../view_error.php"; ?>
                        <div class="input-group">
                        <select name="day_no" class="btn btn-secondary w-100 my-1" >
                            <option value="-1">اختر يوم الاسبوع</option>
                            <option value="1">الاحد</option>
                            <option value="2">الاثنين</option>
                            <option value="3">الثلاثاء</option>
                            <option value="4">الاربع</option>
                            <option value="5">الخميس</option>
                        </select>
                        </div>
                        <div class="input-group">
                        <select name="bus" class="btn btn-secondary w-100 my-1">
                            <option value="-1">اختر رقم الحافله</option>
                            <?php while ($arr=mysqli_fetch_array($brslt))
                            {
                                echo " <option value=\"$arr[0]\">$arr[1]</option>";
                            }
                            ?>
                        </select>
                        </div>
                        <div class="input-group">
                        <select name="line" class="btn btn-secondary w-100 my-1">
                            <option value="-1">اختر مسار الرحله</option>
                            <?php while ($arr=mysqli_fetch_array($blrslt))
                            {
                                echo " <option value=\"$arr[0]\">$arr[1]</option>";
                            }
                            ?>
                        </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-success" onclick="submit()" ID="Button1">اضف الرحله</button>
                    </form>


                </div>

                <div class="col-12 bg-light text-warning  rounded py-5 px-4">

                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>التفاصيل</th>
                            <th>تعديل</th>
                            <th>يوم الرحله</th>
                            <th>رقم الحافله</th>
                            <th>اسم المسار</th>
                            <th>رقم الرحله</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($arr=mysqli_fetch_array($trslt))
                        { ?>
                        <tr>
                            <td><a href="trip_details.php?tid=<?php echo $arr[0]?>">التفاصيل</a></td>

                            <td><a href="trip_edit.php?tid=<?php echo $arr[0]?>">تعديل</a></td>
                            <td><?php echo $days[$arr[1]]?></td>
                            <td><?php echo $arr[2]?></td>
                            <td><?php echo $arr[3]?></td>
                            <td><?php echo $arr[0]?></td>
                        </tr>
                    <?php }?>
                    </table>


                </div>
            </div>






        </div>
    </div>


    <script>

        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>


<?php include  "footer.php";?>