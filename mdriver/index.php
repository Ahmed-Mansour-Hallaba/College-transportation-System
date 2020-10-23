<?php include  "header.php";?>
    <!-- page content -->
<?php
    $dcn=mysqli_connect(Host,UN,PW,DBname);
    $drslt=mysqli_query($dcn,"select d.id,u.fullname,d.mobile,b.busnumber,b.color,b.capacity,d.state,count(f.message) from drivers d join users u on(d.id=u.id) join buses b on(d.bus_id=b.id) left join feedback f on(d.id=f.fto)  group by (d.id) order by d.state");

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
                <div class="col-12 bg-light text-warning  rounded py-3 px-4">
                    <h3 class="py-2 font-weight-bold">متابعه السائقين </h3>
                    <hr class="py-1">
                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>تفاصيل السائق</th>
                            <th>حاله</th>
                            <th>عدد الشكاوي</th>
                            <th>سعه الحافله</th>
                            <th>لون الحافله</th>
                            <th>رقم اللوحه</th>
                            <th>جوال السائق</th>
                            <th>اسم السائق</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($darr=mysqli_fetch_array($drslt))
                        {
                            if($darr[6]=='pending')
                                $state='تحت المراجعه';
                            else if($darr[6]=='accepted')
                                $state='موافق عليه';
                            else if($darr[6]=='refused')
                                $state='مرفوض';
                            ?>
                        <tr>
                            <td><a href="driver_details.php?did=<?php echo $darr[0]?>">تفاصيل السائق</a> </td>
                            <td><?php echo $state?></td>
                            <td><?php echo $darr[7]?></td>
                            <td><?php echo $darr[5]?></td>
                            <td><?php echo $darr[4]?></td>
                            <td><?php echo $darr[3]?></td>
                            <td><?php echo $darr[2]?></td>
                            <td><?php echo $darr[1]?></td>
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