<?php include  "header.php";?>
    <!-- page content -->
<?php

$pcn=mysqli_connect(Host,UN,PW,DBname);
$prslt=mysqli_query($pcn,"select * from bus_lines");

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
                    <h3 class="py-2 font-weight-bold">جدول المسارات</h3>
                    <hr class="py-1">
                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>التفاصيل</th>
                            <th>الاتجاه</th>
                            <th>وقت وصول الحافلة </th>
                            <th>اسم المسار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($darr=mysqli_fetch_array($prslt))
                        {
                            if($darr[2]=='to')
                                $dir="متجه الي الجامعه";
                            else $dir="متجه من الجامعه"
                            ?>
                            <tr>
                                <td><a href="path_details.php?pid=<?php echo $darr[0] ?>">التفاصيل</a></td>
                                <td><?php echo $dir ?></td>
                                <td><?php echo $darr[3] ?></td>
                                <td><?php echo $darr[1] ?></td>


                            </tr>
                        <?php } ?>
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