<?php include  "header.php";?>
    <!-- page content -->
<?php
if($auth==false)
{
    echo "<script>";
    echo 'window.location.href = "index.php"';
    echo "</script>";
}
$days=array('*','الاحد','الاثنين',"الثلاثاء","الاربعاء","الخميس");
?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <form   id="foo" class="col-md-10 bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">حجز المواعيد</h3>
                    <hr class="py-1">
                    <?php include "../view_error.php";?>
                    <?php for($i=1;$i<6;$i++)
                    {
                        $cnf=mysqli_connect(Host,UN,PW,DBname);
                        $cnt=mysqli_connect(Host,UN,PW,DBname);
                        $frslt=mysqli_query($cnf,"call gettripsto('$i','$login')");
                        $trslt=mysqli_query($cnt,"call gettripsfrom('$i','$login')");

                        ?>
                    
                    <div class="input-group my-2">
                        <select name="from_<?php echo $i?>" class="btn btn-secondary" >
                        <option value="-1">اختررحلة الذهاب</option>
                            <?php while($arr=mysqli_fetch_array($frslt))
                            {
                                $cnct=mysqli_connect(Host,UN,PW,DBname);
                                $ctrslt=mysqli_query($cnct, "select count(*) from trips t join  student_schedule ss on(ss.trip_id=t.id) join buses  b on (t.bus_id=b.id) where t.id=$arr[0]" );
                                $ctarr=mysqli_fetch_array($ctrslt);
                                $rem=$arr[3]-$ctarr[0];
                                ?>

                                <option value="<?php echo $arr[0]?>"><?php echo "من $arr[1] الي  $arr[2] رقم الرحله $arr[0] المتبقي $rem"?></option>
                            <?php } ?>
                        </select>  
                        <select name="to_<?php echo $i?>" class="btn btn-secondary" >
                                <option value="-1">اختر رحلة العودة</option>
                                <?php while($arr=mysqli_fetch_array($trslt))
                                {
                                    ?>
                                    <option value="<?php echo $arr[0]?>"><?php echo "من $arr[1] الي  $arr[2] رقم الرحله $arr[0] المتبقي $rem"?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                            <span class="input-group-text" style="width:100px"><?php echo $days[$i]?></span>
                            <span class="input-group-text"><input type="checkbox" name="check_<?php echo $i?>" aria-label="Checkbox for following text input"></span>
                        </div>  
                    </div>
                    <?php }?>
                    
                    
                    
                    
                    <br>
                    <input type="submit" value="حفظ" class="btn btn-success">
                    <div id="response">

                    </div>
                </form>

                <div class="col-md">

                </div>
            </div>






        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#foo').submit(function(){
                $('#response').html("<b>جاري التحميل</b>");
                $.ajax({
                    type: 'POST',
                    url: 'process/reserve1.php',
                    data: $(this).serialize()
                })
                    .done(function(data){
                        $('#response').html(data);

                    })
                    .fail(function() {
                        alert( "فشل " );

                    });
                return false;
            });
        });
    </script>

<?php include  "footer.php";?>