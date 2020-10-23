<?php include  "header.php";?>
    <!-- page content -->
<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$brslt=mysqli_query($dcn,"select * from buses");
$blrslt=mysqli_query($pcn,"select * from bus_lines");
if($auth==true)
    $trslt=mysqli_query($pcn,"select  t.id,day_no,busnumber,line_name from trips t join buses b on(b.id=t.bus_id) join bus_lines bl on (bl.id=t.line_id) join line_details ld on(bl.id=ld.line_id) join students s on(s.district_id=ld.district_id) where s.id=$login");
else $trslt=mysqli_query($pcn,"select t.id,day_no,busnumber,line_name from trips t join buses b on(b.id=t.bus_id) join bus_lines bl on (bl.id=t.line_id)");
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
                <div class="col-12 bg-light text-warning text-right rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">جدول الرحلات اليوميه</h3>
                    <hr class="py-1">
                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>التفاصيل</th>
                            <th>يوم الرحله</th>
                          <?php if($login>0) {?>  <th>رقم الحافله</th> <?php }?>
                            <th>اسم المسار</th>
                            <th>رقم الرحله</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($arr=mysqli_fetch_array($trslt))
                        { ?>
                        <tr>
                            <td><a href="trip_details.php?tid=<?php echo $arr[0]?>">التفاصيل</a></td>
                            <td><?php echo $days[$arr[1]]?></td>
                            <?php if($login>0) {?>    <td><?php echo $arr[2]?></td> <?php }?>
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