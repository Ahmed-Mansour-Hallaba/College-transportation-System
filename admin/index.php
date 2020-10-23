<?php include  "header.php";?>
    <!-- page content -->

    <style>
        thead,tbody,tfoot,tr,td{
            width:100% !important;
            white-space:nowrap;

        }
    </style>
<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$drslt=mysqli_query($dcn,"select d.id,u.fullname,d.mobile,b.busnumber,b.color,b.capacity,d.state from drivers d join users u on(d.id=u.id) join buses b on(d.bus_id=b.id) where state='accepted'");
$month=date('m');
$year=date('Y');
if(isset($_GET['m'])and isset($_GET['y']) and $_GET['m']!='NaN'and $_GET['y']!='NaN')
{
    $month=$_GET['m'];
    $year=$_GET['y'];
}
?>




    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-right " style="position:relative;">
            <div class="row px-2">




                <div class="col-12 bg-light text-warning  rounded py-5 px-4">
                    <h3 class="py-2 font-weight-bold">التقرير </h3>
                 <form>
                     <input type="month" name="dat" id="dat" class="form-control">
                     <a class="btn btn-warning text-dark" onclick="sub()">اختيار</a>
                 </form>
                    <table id="myTable" class="table table-responsive table-bordered table-hover  ">
                        <thead >
                        <tr>

                            <th>الراتب الشهري </th>
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

                            $cn1=mysqli_connect(Host,UN,PW,DBname);
                            $cn2=mysqli_connect(Host,UN,PW,DBname);
                            $rslt1=mysqli_query($cn1,"call get_offdays('$darr[0]',$month,$year)");
                            $rslt2=mysqli_query($cn2,"call  estimated_salary('$darr[0]')");
                            $arr1=mysqli_fetch_array($rslt1);
                            $arr2=mysqli_fetch_array($rslt2);
                            $mon=($arr2[0]*4-$arr1[0])*10;
                            ?>
                            <tr>

                                <td><?php echo $mon;?></td>
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
    function sub() {
        debugger
        var d=new Date($('#dat').val());
        var m=d.getMonth();
        var y=d.getFullYear();
        m++;
        window.location.href = "index.php?m="+m+"&y="+y;

    }

</script>




<?php include  "footer.php";?>