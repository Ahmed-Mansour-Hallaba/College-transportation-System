<?php include  "header.php";?>
<?php
if(!isset($_GET['did']))
{
    echo "<script>";
    echo 'window.location.href = "districts.php"';
    echo "</script>";
}
$did=$_GET['did'];
$dcn=mysqli_connect(Host,UN,PW,DBname);
$drslt=mysqli_query($dcn,"select * from districts where id ='$did'");
$darr=mysqli_fetch_array($drslt);
?>

    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <div class="col-md bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">تعديل الحي</h3>
                    <hr class="py-1">
                    <form method="post" action="process/edit_district.php">

                        <input type="hidden" name="did" value="<?php echo $darr[0] ?>">
                        <div class="input-group">
                            <input type="text" class="form-control text-right" name="dist_name" value="<?php echo $darr[1] ?>" placeholder="اسم المنطقه" aria-label="Recipient's username" aria-describedby="basic-addon2">

                        
                        </div>

                        <br>
                        

                        <button type="button" onclick="submit()" class="btn btn-success" ID="Button1">عدل الحي</button>
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