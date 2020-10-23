<?php include  "header.php";?>
    <!-- page content -->
<?php
if(!isset($_GET['pid']))
{
    echo "<script>";
    echo 'window.location.href = "paths.php"';
    echo "</script>";
}
$pid=$_GET['pid'];
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$pdcn=mysqli_connect(Host,UN,PW,DBname);
$drslt=mysqli_query($dcn,"select * from districts");
$drslt1=mysqli_query($dcn,"select * from districts");
$drslt2=mysqli_query($dcn,"select * from districts");
$prslt=mysqli_query($pcn,"select * from bus_lines where id=$pid");
$pdrslt=mysqli_query($pdcn,"select * from line_details where line_id=$pid");
$parr=mysqli_fetch_array($prslt);
?>
    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <div class="col-md-8 bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">تعديل المسار </h3>
                    <hr class="py-1">
                    <form method="post" action="process/edit_path.php">
                        <?php include "../view_error.php";?>
                        <input type="hidden" value="<?php echo $parr[0]?>" name="pid">
                        <div class="form-check form-check-inline m-0  pb-2" id="radiogroup">
                            <label class="form-check-label">
                                <input type="radio" name="dir" <?php if($parr[2]=='to') echo 'checked';?> value="1"> متجه الي الكليه
                            </label>
                            <label class="form-check-label mx-2">
                                <input type="radio" name="dir" <?php if($parr[2]=='from') echo 'checked';?> value="2" >متجه من الكليه
                            </label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="pname" class="form-control text-right" value="<?php echo $parr[1]?>" placeholder="مثال: المسار الاول" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; اسم المسار</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="time" name="col_time" value="<?php echo $parr[3]?>" class="form-control text-right" placeholder="وقت الوصول للكليه" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text">وقت الوصول للكليه</span>
                            </div>
                        </div>
                        <input type="button" onclick="adddistrict()" class="btn btn-success my-2" value="اضافه حي جديد">
                        <div id="districts"></div>
                            <input type="hidden" value="0" name="districtcount" id="districtcount">
                            <br>
                            <button type="button" onclick="submit()" class="btn btn-success" ID="Button1">تعديل</button>
                    </form>
                </div>

                <div class="col-md">

                </div>
            </div>






        </div>
    </div>



    <script>
        count=$("#districtcount").val();

        /*
         <div class="input-group">
         <select><option>اختر الحي</option><option>الريان</option><option>االمنار</option></select>
         <input type="text" class="form-control text-right" placeholder="وقت المنطقه" aria-label="Recipient's username" aria-describedby="basic-addon2">
         </div>

         */
        function adddistrict1(did,dtime) {
            debugger;
            var districtarr1=[];
            var districtarr2=[];
            for(i=1;i<=count;i++)
            {

                x="districtcombo_"+i.toString();
                y="districttime_"+i.toString();
                districtarr1.push($("#"+x).val());
                districtarr2.push($("#"+y).val());


            }
            $("#districts").empty();
            s="";
            count++;
            districtarr1.push(did);
            districtarr2.push(dtime);
            for(i=1;i<=count;i++)
            {
                s+='<div class="input-group my-2 "><div class="input-group-prepend"><input onclick="deletedistrict('+i+')" type="button" class="btn btn-danger" value="احذف الحي">';
                s+='<select id="districtcombo_'+i+'" name="districtcombo_'+i+'"> <option value="-1"';
                if(districtarr1[i-1]==-1){ s+="selected ";}
                s+='>الحي</option>';
                <?php
                while ($darr=mysqli_fetch_array($drslt2))
                {
                ?>

                s+='<option value="<?php echo $darr[0];?>"';

                if(districtarr1[i-1]==<?php echo $darr[0];?>){ s+="selected ";}
                s+= '>';
                s+= '<?php echo $darr[1];?>';
                s+='</option>';
                <?php }?>
                s+='</select></div>'
                s+='<input type="time" class="form-control text-right" value="'+districtarr2[i-1]+'" id="districttime_'+i+'" name="districttime_'+i+'" placeholder="وقت الوصول للحي">';
                s+='<div class="input-group-append"><span class="input-group-text" >وقت وصول الحى</span><span class="input-group-text" >الحي '+i+'</span></div></div>';
            }
            $("#districts").html(s);
            $("#districtcount").val(count);

        }

        function adddistrict() {
            debugger;
            var districtarr1=[];
            var districtarr2=[];
            for(i=1;i<=count;i++)
            {

                x="districtcombo_"+i.toString();
                y="districttime_"+i.toString();
                districtarr1.push($("#"+x).val());
                districtarr2.push($("#"+y).val());


            }
            $("#districts").empty();
            s="";
            count++;
            districtarr1.push("-1");
            districtarr2.push("");
            for(i=1;i<=count;i++)
            {
                s+='<div class="input-group my-2 "><div class="input-group-prepend"><input onclick="deletedistrict('+i+')" type="button" class="btn btn-danger" value="احذف الحي">';
                s+='<select id="districtcombo_'+i+'" name="districtcombo_'+i+'"> <option value="-1"';
                if(districtarr1[i-1]==-1){ s+="selected ";}
                s+='>الحي</option>';
                <?php
                while ($darr=mysqli_fetch_array($drslt))
                {
                ?>

                s+='<option value="<?php echo $darr[0];?>"';

                if(districtarr1[i-1]==<?php echo $darr[0];?>){ s+="selected ";}
                s+= '>';
                s+= '<?php echo $darr[1];?>';
                s+='</option>';
                <?php }?>
                s+='</select></div>'
                s+='<input type="time" class="form-control text-right" value="'+districtarr2[i-1]+'" id="districttime_'+i+'" name="districttime_'+i+'" placeholder="وقت الوصول للحي">';
                s+='<div class="input-group-append"><span class="input-group-text" >وقت وصول الحى</span><span class="input-group-text" >الحي '+i+'</span></div></div>';
            }
            $("#districts").html(s);
            $("#districtcount").val(count);

        }

        function deletedistrict(n)
        {
            debugger;
            var districtarr1=[];
            var districtarr2=[];
            for(i=1;i<=count;i++)
            {
                if(i!=n)
                {
                    x="districtcombo_"+i.toString();
                    y="districttime_"+i.toString();
                    districtarr1.push($("#"+x).val());
                    districtarr2.push($("#"+y).val());}
            }
            count--;
            $("#districts").empty();
            s="";
            for(i=1;i<=count;i++)
            {
                s+='<div class="input-group my-2 "><div class="input-group-prepend"><input onclick="deletedistrict('+i+')" type="button" class="btn btn-danger" value="احذف الحي">';
                s+='<select id="districtcombo_'+i+'" name="districtcombo_'+i+'"> <option value="-1"';
                if(districtarr1[i-1]==-1){ s+="selected ";}
                s+='>الحي</option>';
                <?php
                while ($darr=mysqli_fetch_array($drslt1))
                {
                ?>

                s+='<option value="<?php echo $darr[0];?>"';

                if(districtarr1[i-1]==<?php echo $darr[0];?>){ s+="selected ";}
                s+= '>';
                s+= '<?php echo $darr[1];?>';
                s+='</option>';
                <?php }?>
                s+='</select></div>'
                s+='<input type="time" class="form-control text-right" value="'+districtarr2[i-1]+'" id="districttime_'+i+'" name="districttime_'+i+'" placeholder="وقت الوصول للحي">';
                s+='<div class="input-group-append"><span class="input-group-text" >وقت وصول الحى</span><span class="input-group-text" >الحي '+i+'</span></div></div>';
            }
            $("#districts").html(s);
            $("#districtcount").val(count);

        }
        <?php
                $cn=0;
        while ($darr=mysqli_fetch_array($pdrslt))
        {
            $t=$darr[1];
            $d=$darr[2];

            echo "adddistrict1($d,'$t');";
            $cn++;
        }

        echo"$('#districtcount').val($cn)";
        ?>
    </script>
<?php include  "footer.php";?>