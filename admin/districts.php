<?php include  "header.php";?>
<?php
    $dcn=mysqli_connect(Host,UN,PW,DBname);
    $drslt=mysqli_query($dcn,"select * from districts where active='1'");
?>
    <!-- page content -->

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
                    <h3 class="py-2 font-weight-bold">إضافة حي جديد </h3>
                    <hr class="py-1">


                    <form method="post" action="process/add_district.php">
                       
                        <div class="input-group">
                            <input type="text" name="dist_name" class="form-control text-right" placeholder="اسم الحي " aria-label="Recipient's username" aria-describedby="basic-addon2">

                        
                        </div>

                        <br>
                        

                        <button type="button" onclick="submit()" class="btn btn-success" ID="Button1">إضافة حي</button>
                    </form>


                </div>

                <div class="col-12 bg-light text-warning  rounded py-5 px-4">

                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>حذف</th>
                            <th>تعديل</th>
                            <th>اسم الحي</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($darr=mysqli_fetch_array($drslt))
                            {


                        ?>
                        <tr>
                            <?php  echo "<td><a href=\"process/del_district.php?did=$darr[0]\">خذف</a></td>" ; ?>
                            <td><a href="district_edit.php?did=<?php echo $darr[0] ?>">تعديل</a></td>
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