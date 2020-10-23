<?php include  "header.php";?>
    <!-- page content -->

    <style>

    </style>
    <div class="border border-secondary border-top-0" style="background-color:#50ad5b;padding-top:100px;padding-bottom:50px;">
        <div class="container text-center " style="position:relative;">
            <div class="row px-2">
                <div class="col-md">

                </div>

                <form id="foo"   class="col-md bg-light text-warning text-center rounded p-4 my-3 w-md-50 ">
                    <h3 class="py-2 font-weight-bold">الاعتذار</h3>
                    <hr class="py-1">

                    <br>
                    <div class="input-group">
                        <input type="date"  name="dat" class="form-control text-right" placeholder="أكتب أكتب أكتب " aria-label="Search for...">
                        <span class="input-group-text" style="width:100px">اليوم</span>
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