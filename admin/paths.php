<?php include  "header.php";?>
    <!-- page content -->
<?php
$dcn=mysqli_connect(Host,UN,PW,DBname);
$pcn=mysqli_connect(Host,UN,PW,DBname);
$drslt=mysqli_query($dcn,"select * from districts");
$drslt1=mysqli_query($dcn,"select * from districts");
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

                <div class="col-12 bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">اضافه مسار جديد </h3>
                    <hr class="py-1">
                    <form action="process/add_path.php" method="post">

                        <?php include "../view_error.php";?>
                        <div class="form-check form-check-inline m-0  pb-2" id="radiogroup">
                            <label class="form-check-label">
                                <input type="radio" name="dir" checked value="1"> متجه الي الكليه
                            </label>
                            <label class="form-check-label mx-2">
                                <input type="radio" name="dir" value="2" >مغادر من الكلية
                            </label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="pname" class="form-control text-right" placeholder="مثال: المسار الاول" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; اسم المسار</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="time" name="col_time" class="form-control text-right" placeholder="وقت الوصول للكليه" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text">وقت الوصول للكليه</span>
                            </div>
                        </div>
                        <input type="button" onclick="adddistrict()" class="btn btn-success my-2" value="اضافه حي جديد">
                        <div  id="districts">

                        </div>
                        <input type="hidden" value="0" name="districtcount" id="districtcount">
                        <br>
                        <button type="button" onclick="submit()" class="btn btn-success" ID="Button1">سجل المسار</button>
                    </form>


                </div>

                <div class="col-12 bg-light text-warning  rounded py-5 px-4">

                    <table id="myTable" class="table table-responsive table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th>اسم المسار</th>
                            <th>وقت وجود الباص في الجامعه</th>
                            <th>الاتجاه</th>
                            <th>تعديل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($darr=mysqli_fetch_array($prslt))
                        {
                            if($darr[2]=='from')
                                $dir="متجه من الكليه";
                            else $dir='متجه الي الكليه';
                            ?>
                            <tr>
                                <td><a href="path_edit.php?pid=<?php echo $darr[0] ?>">تعديل</a></td>
                                <td><?php echo $darr[3] ?></td>
                                <td><?php echo $dir ?></td>
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

    <script>
        count=0;

        /*
         <div class="input-group">
         <select><option>اختر الحي</option><option>الريان</option><option>االمنار</option></select>
         <input type="text" class="form-control text-right" placeholder="وقت المنطقه" aria-label="Recipient's username" aria-describedby="basic-addon2">
         </div>

         */
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

    </script>


<?php include  "footer.php";?>