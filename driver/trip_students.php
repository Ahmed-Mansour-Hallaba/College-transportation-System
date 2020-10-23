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
$rsltrev=mysqli_query($dcn,"call trip_students('$tid')");

?>
    <style>

    </style>

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
                <h3 class="py-2 font-weight-bold">جدول رحلاتي</h3>
                <hr class="py-1">
                <table id="myTable" class="table table-responsive table-bordered table-hover ">
                    <thead >
                    <tr>

                        <th>عرض صوره المنزل</th>
                        <th>اسم المنطقه</th>
                        <th>عنوان الطالبه</th>
                        <th>الرقم الجامعي</th>
                        <th>جوال الطالبه</th>
                        <th>اسم الطالبه</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    function escapeJavaScriptText($string)
                    {
                        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
                    }
                    while ($arrtl=mysqli_fetch_array($rsltrev))
                    {
                        $str=escapeJavaScriptText($arrtl[5]);
                        ?>

                        <tr>

                            <td> <a onclick="modalchange('<?php echo $str?>')" href="#showphoto" data-toggle="modal" data-target="#showphoto">عرض</a></td>
                            <td><?php echo $arrtl[4];?></td>
                            <td><?php echo $arrtl[3];?></td>
                            <td><?php echo $arrtl[2];?></td>
                            <td><?php echo $arrtl[1];?></td>
                            <td><?php echo $arrtl[0];?></td>
                        </tr>

                    <?php }?>


                    </tbody>

                </table>


            </div>
        </div>

    </div>

    <div class="modal fade" id="showphoto" tabindex="-1" role="dialog" aria-labelledby="mymodallabel" >
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content " id="modalphoto">
                <img class="img-fluid w-100 rounded" src="img\2.jpg" alt="Card image">
            </div>
        </div>
    </div>
    <script>
        function modalchange(str) {
            debugger;
            s='<img class="img-fluid w-100 rounded" src="';
            s+=str;
            s+='"alt="Card image">';
            //  alert(s);
            document.getElementById('modalphoto').innerHTML=s;

        }


    </script>

<?php include  "footer.php";?>