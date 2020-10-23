


 <div style="background-color:#ceac1e;color:#FFFFFF ;position:relative;opacity:.9;">
        <div class="container text-right">
            <div class=" row py-5">

            
            <div class="col-md-3  text-center">
                    <img class="d-block mx-auto img-fluid" src="..\img\logo.png" style="height:150px;position:relative;" alt="Second slide">

                    <p class="footer-company-name">جامعة حفرالباطن &copy; 2019</p>
                </div>


                
                <div class="col-md-5 ">
                        <div class="row text-right">
                            <div class="col-12 py-3">
                                <p class="d-inline h5"> جامعة حفرالباطن حي الورود - مجمع الطالبات  <i class="fas fa-map-marker mx-1  fa-lg"></i></p>
                            </div>
                            <div class="col-12 py-3">
                                <p class="d-inline h5"> +966 7210011 <i class="fas fa-phone mx-1 fa-lg"></i></p>
                            </div>
                            <div class="col-12 py-3">
                                <p class="d-inline h5"> <a href="mailto:support@company.com">UHB-BUS@uhb.edu.sa</a> <i class="fas fa-envelope fa-lg mx-1"></i></p>
                            </div>
                        </div>
                

                </div>

                <div class="col-md-4 ">
                    
                    <p class="footer-company-about">
                        <h3>عن المشروع</h3><br>
                        توفر الجامعة خدمة النقل الآمن للطلبات و ذلك عن طريقة  التسجيل عبر الموقع الاكتروني و تأكيد التسجسل و الدفع عبر مواقعنا بالكليت 
                    </p>
    
                    <div class=" text-white">
    
                        <a href="https://m.facebook.com/uhb.bus" class="px-2"><i class="fab fa-3x fa-facebook text-white"></i></a>
                        <a href="https://twitter.com/UHB_BUS" class="px-2"><i class="fab fa-3x fa-twitter text-white"></i></a>
                        <a href="https://instagram.com/uhb_bus?utm_source=ig_profile_share&igshid=v6ql35vrheww" class="px-2"><i class="fab fa-3x fa-instagram text-white"></i></a>
                      
    
                    </div>
                    </div>


            </div>
        </div>
    </div>

    <div style="background-color:#d15015;height: 10px;position:relative;">
    </div>


    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
        style="margin-top:50px;direction: rtl">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">

                <div class="modal-header">
                    <h4 class="modal-title text-danger text-right" id="mymodallable2">تسجيل دخول </h4>
                </div>

                <div class="modal-body text-right">
                    <div class="container-fluid" style="text-align:right">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span
                                    class="glyphicon glyphicon-user"></span></span>
                            <input class="form-control" aria-describedby="basic-addon1" ID="loginusername"
                                placeholder="أسم المستخدم" AutoCompleteType="None" autofocus requiredtype="text" />
                        </div>
                        <br />
                        <div class="input-group">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginpassword"
                                TextMode="Password" placeholder="كلمة المرور" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        <br />
                        <p class="text-left" style="font-weight:bold;font-size:12px;"><input id="Checkbox1"
                                type="checkbox" /> تذكر هذا المستخدم</p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success mx-2" ID="Button1">دخول</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="registeration" tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
        style="margin-top:50px;direction: rtl">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">

                <div class="modal-header">
                    <h4 class="modal-title text-danger text-right" id="mymodallable2">التسجيل فى الموقع </h4>
                </div>

                <div class="modal-body text-right">
                    <form method="post" action="process/register.php" enctype="multipart/form-data" class="container-fluid" style="text-align:right">
                        <?php
                        if(isset($_SESSION['error1']))
                        { $er=$_SESSION['error1'];
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $er;?>
                        </div>
                        <?php
                        }
                        ?>

                        <div class="form-check form-check-inline m-0  pb-1" id="radiogroup">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="usertype" checked id="watcher" value="2"> طالبة
                            </label>
                            <label class="form-check-label mx-2">
                                <input class="form-check-input" type="radio" name="usertype"  id="talent" value="1"> سائق
                            </label>
                        </div>                        
                        <div class="input-group pb-1">
                            <span class="input-group-addon" id="basic-addon1"><span
                                    class="glyphicon glyphicon-user"></span></span>
                            <input class="form-control" aria-describedby="basic-addon1" ID="name" name="fname"
                                placeholder="الأسم بالكامل" AutoCompleteType="None" autofocus requiredtype="text" />
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginusername" name="uname"
                                TextMode="Password" placeholder="أسم المستخدم" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginpassword" name="pass"
                                TextMode="Password" placeholder="كلمة المرور" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginpassword" name="mob"
                                TextMode="Password" placeholder="الجوال" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        
                        <div id="student">
                        <div class="input-group pb-1">
                            <span class="input-group-addon" id="basic-addon1"><span
                                    class="glyphicon glyphicon-user"></span></span>
                            <input class="form-control" aria-describedby="basic-addon1" ID="name" name="pmob"
                                placeholder="الرقم الجامعي" AutoCompleteType="None" autofocus requiredtype="text" />
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginusername" name="adr"
                                TextMode="Password" placeholder="العنوان بالتفصيل" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        
                        <div class="form-group row pb-1">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-left">الحى</label>
                            <div class="col-sm-9">
                                <select id="inputState" name="did" class="form-control">
                                    <?php
                                    $dcn=mysqli_connect(Host,UN,PW,DBname);
                                    $drslt=mysqli_query($dcn,"select * from districts where active='1'");
                                    while ($arr=mysqli_fetch_array($drslt))
                                    {
                                        echo "<option value='$arr[0]'> $arr[1] </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row pb-1">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-left">أرفع صورة المنزل</label>
                            <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1" >
                            </div>
                        </div>
                        <img class="d-block" src="..\img\cover2.jpg" style="width:100%;position:relative;" alt="Second slide">

                        </div>
                    
                        <div id="driver" style="display:none;">
                        <div class="input-group pb-1">
                            <span class="input-group-addon" id="basic-addon1"><span
                                    class="glyphicon glyphicon-user"></span></span>
                            <input class="form-control" aria-describedby="basic-addon1" ID="name" name="busnumber"
                                placeholder="رقم الحافلة" AutoCompleteType="None" autofocus requiredtype="text" />
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginusername" name="color"
                                TextMode="Password" placeholder="لون الحافلة" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>
                        <div class="input-group pb-1">
                            <input class="form-control" aria-describedby="basic-addon2" ID="loginusername" name="cap"
                                TextMode="Password" placeholder="سعة الحافلة" AutoCompleteType="None" required
                                type="text" />
                            <span class="input-group-addon" id="basic-addon2"><span
                                    class="glyphicon glyphicon-lock"></span></span>
                        </div>

                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="submit()" class="btn btn-success mx-2">تسجيل</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
        style="margin-top:50px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-body text-right">
                    <div class="container-fluid" style="text-align:right">
                        <div class="input-group">
                            <span class="input-group-addon  rounded-left" id="basic-addon1"><button type="button"
                                    class="btn btn-success  rounded-left" ID="Button1"><i
                                        class="fas fa-search"></i></button></span>
                            <input class="form-control  rounded-right" aria-describedby="basic-addon1"      ID="loginusername" placeholder="أدخل كلمة البحث" AutoCompleteType="None" autofocus
                                requiredtype="text" />
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>




 <div class="modal fade" id="notification" onclick="showAnnouncments()" tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
      style="margin-top:50px;direction: rtl">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content ">
             <div class="modal-header">
                 <h4 class="modal-title text-danger text-center" id="mymodallable2">الأشعارات </h4>
             </div>

             <div class="modal-body text-right m-0 p-0">
                 <ul class="list-group m-0 p-0" id="announmenu">

                 </ul>
             </div>

         </div>
     </div>
 </div>
 <div class="modal fade" id="feedback"  tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
      style="margin-top:50px;direction: rtl">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content ">
             <div class="modal-header">
                 <h4 class="modal-title text-danger text-center" id="mymodallable2">الشكاوي </h4>
             </div>

             <form id="feedfoo" class="modal-body text-right m-0 p-0">
                 <input type="hidden" name="uid" value="<?php echo $login?>">
                 <div class="form-group row pb-1">
                     <label for="staticEmail" class="col-sm-3 col-form-label text-left">اسم السائق</label>
                     <div class="col-sm-9">
                         <select id="inputState" name="did" class="form-control">
                             <?php
                             $dcn=mysqli_connect(Host,UN,PW,DBname);
                             $drslt=mysqli_query($dcn,"call get_student_drivers('$login')");
                             while ($arr=mysqli_fetch_array($drslt))
                             {
                                 echo "<option value='$arr[0]'> $arr[1] </option>";
                             }
                             ?>
                         </select>
                     </div>

                     <label for="staticEmail" class="col-sm-3 col-form-label text-left">الشكوي</label>

                     <div class="col-sm-9">

                     <textarea class="form-control" name="mes" id="mes">

                     </textarea>

                         <div id="fres">
                         </div>
                     </div>



                 </div>
                 <div class="modal-footer">
                     <input type="submit" class="btn btn-success mx-2" ID="Button1" value="ارسال الشكوي">
                     <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
                 </div>
             </form>

         </div>
     </div>
 </div>
 <div class="modal fade" id="suggest"  tabindex="-1" role="dialog" aria-labelledby="mymodallabel"
      style="margin-top:50px;direction: rtl">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content ">
             <div class="modal-header">
                 <h4 class="modal-title text-danger text-center" id="mymodallable2">الاقتراحات </h4>
             </div>

             <form id="sugfoo" class="modal-body text-right m-0 p-0">
                 <input type="hidden" name="uid" value="<?php echo $login?>">
                 <div class="form-group row pb-1">


                     <label for="staticEmail" class="col-sm-3 col-form-label text-left">الاقتراح</label>

                     <div class="col-sm-9">

                     <textarea class="form-control" name="mes" id="mes">

                     </textarea>

                         <div id="sres">
                         </div>
                     </div>



                 </div>
                 <div class="modal-footer">
                     <input type="submit" class="btn btn-success mx-2" ID="Button1" value="ارسال الاقتراح">
                     <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
                 </div>
             </form>

         </div>
     </div>
 </div>





<!-- particles library -->
<script src="../js/particles.js"></script>
<script src="../js/app.js"></script>

<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>

<script type="text/javascript">

    // Scrolling Effect

    $(window).on("scroll", function () {
        if ($(window).scrollTop()) {
            $('#mainnavbar').removeClass('bg-transparent');
            $('#mainnavbar').addClass('bg-light');

        }

        else {
            $('#mainnavbar').removeClass('bg-light');
            $('#mainnavbar').addClass('bg-transparent');
        }
    });

  
    $('#menubutton').on("click", function () {
        $('#mainnavbar').removeClass('bg-transparent');
        $('#mainnavbar').addClass('bg-light');
    });

    
    $("input[name='usertype']").change(function(e){
    if($("input:radio[name ='usertype']:checked").val() == '2') {
        $('#student').fadeIn();
        $('#driver').fadeOut();
    } else {
        $('#driver').fadeIn();
        $('#student').fadeOut();
    }

});



</script>
 <?php if ($login>0){?>
 <script>
     function announcount() {
         debugger
         var xhttp;
         str=<?php echo $login ?>;
         if (str == "") {
             document.getElementById("not_count").innerHTML = "";
             return;
         }
         xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 document.getElementById("not_count").innerHTML = this.responseText;
             }
         };
         xhttp.open("GET", "process/announcounter.php?q="+str, true);
         xhttp.send();
     }
     function timercount(){
         // do whatever you like here
         announcount();
         setInterval(announcount, 3000);
     }
     timercount();

     function showAnnouncments() {
         debugger;
         var xhttp;
         str=<?php echo $login?>;
         if (str == "") {
             document.getElementById("announmenu").innerHTML = "";
             return;
         }
         xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 document.getElementById("announmenu").innerHTML = this.responseText;
             }
         };
         xhttp.open("GET", "process/getannoun.php?q="+str, true);
         xhttp.send();
         announcount();
     }
     showAnnouncments();
 </script>
     <script>

         $(document).ready(function(){
             $('#feedfoo').submit(function(){
                 $('#fres').html("<b>جاري التحميل</b>");
                 $.ajax({
                     type: 'POST',
                     url: 'process/feedback.php',
                     data: $(this).serialize()
                 })
                     .done(function(data){
                         $('#fres').html(data);

                     })
                     .fail(function() {
                         alert( "فشل ارسال الشكوي " );
                     });
                 return false;

             });
         });
     </script>
     <script>

         $(document).ready(function(){
             $('#sugfoo').submit(function(){
                 $('#sres').html("<b>جاري التحميل</b>");
                 $.ajax({
                     type: 'POST',
                     url: 'process/suggest.php',
                     data: $(this).serialize()
                 })
                     .done(function(data){
                         $('#sres').html(data);

                     })
                     .fail(function() {
                         alert( "فشل ارسال الشكوي " );
                     });
                 return false;

             });
         });
     </script>
 <?php }?>

 <?php

 if($_SESSION['error1'])
     echo'
 <script>
     $("#registeration").modal()
 </script>';
 unset($_SESSION['error1']);
 ?>
</body>

</html>