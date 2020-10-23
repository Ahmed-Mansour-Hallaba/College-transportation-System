<?php include  "header.php";?>
    <!-- page content -->
<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$erslt=mysqli_query($dcn,"select e.id,e.execuse_date,u.fullname from execuses e join users u on(u.id=e.driver_id) where e.solved =0");


?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#b3ada9;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row ">
                <div class="col-md">

                </div>

                <form id="foo"   class="col-md bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">معالجه الاعتذار</h3>
                    <hr class="py-1">
                    <div class="input-group">
                        <select name="execuse">
                            <?php
                                $t=0;
                                while ($earr=mysqli_fetch_array($erslt))
                                {
                                    $t=1;
                                    echo "<option value='$earr[0]'>$earr[1] $earr[2] </option>";
                                }
                            ?>

                        </select>
                        <span class="input-group-text" style="width:150px">اسم السائق و التاريخ</span>

                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text"  name="dname" class="form-control text-right"aria-label="Search for...">
                        <span class="input-group-text" style="width:150px">اسم السائق</span>
                        <span class="input-group-btn">
      </span>
                    </div>
                    <br> <div class="input-group">
                        <input type="text"  name="color" class="form-control text-right"  aria-label="Search for...">
                        <span class="input-group-text" style="width:150px">لون الحافله</span>
                        <span class="input-group-btn">
      </span>
                    </div>
                    <br> <div class="input-group">
                        <input type="text"  name="bno" class="form-control text-right" aria-label="Search for...">
                        <span class="input-group-text" style="width:150px">رقم اللوحه</span>
                        <span class="input-group-btn">
      </span>
                    </div>
                    <br>
                    <input type="submit"  class="btn btn-success" value="اعتذر">
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
                    url: 'process/apologize.php',
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