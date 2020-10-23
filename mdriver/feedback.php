<?php include  "header.php";?>
    <!-- page content -->

<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$brslt=mysqli_query($dcn,"select fu.fullname,tu.fullname,f.message from feedback f join users fu  on (fu.id=f.ffrom) join users tu  on (tu.id=f.fto)");
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



                <div class="col-12 bg-light text-warning  rounded py-5 px-4">

                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>الشكوي</th>
                            <th>اسم السائق</th>
                            <th>اسم الطالبه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($arr=mysqli_fetch_array($brslt))
                        { ?>
                        <tr>
                            <td><?php echo $arr[2]?></td>
                            <td><?php echo $arr[1]?></td>
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