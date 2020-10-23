<?php
include  "mdriveronly.php";
include "../dbinfo.php";
$ucn=mysqli_connect(Host,UN,PW,DBname);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$login=$_SESSION['uid'];
$urslt=mysqli_query($ucn,"select * from users where id=$login");
$uarr=mysqli_fetch_array($urslt);

?>
<!doctype html>
<html>

<head>

    <title>UHB BUS</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1,shrink-to-fit=no" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-16" />


    <!-- Fontawesome library -->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <!-- jQuery library -->
    <script src="../js/jquery-3.1.1.min.js"></script>

    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- video.js library -->
    <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">

    <!-- stars rating library -->
    <link href="../css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../js/star-rating.min.js" type="text/javascript"></script>

    <!-- pagination.min.js library -->
    <link rel="stylesheet" href="../css/jquery.paginate.css">
    <script src="../js/jquery.paginate.js"></script>

    <!-- Fontawesome library -->
  <!--  <script src="../js/fontawesome-all.js"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- OwlCarousel 2-2.3.4 library -->
    <script src="../js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- Bootstrap 4.1.1 library -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">


    <style>
        html,
        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Cairo', sans-serif;
        }

        #particles-js {
            height: 100%;
            z-index: 0;
            background-color: #b3ada9;
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .carousel-caption{
            background-color: black;
            opacity: .75;
            width: 100%;
            bottom: 40%;

            left:0%;



        }
        .card-img-overlay{
            background-color: black;
            opacity: .65;
        }



    </style>

</head>
<body>

<nav id="mainnavbar" class="navbar navbar-expand-md navbar-light bg-transparent fixed-top font-weight-bold"
     style="transition: all 1s ease-out;direction: rtl;">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="img-fluid d-block" src="../img/logo.png" style="" width="50px">
        </a>
        <button class="navbar-toggler navbar-toggler-right" id="menubutton" type="button" data-toggle="collapse"
                data-target="#navbarDarkSupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center  justify-content-end" id="navbarDarkSupportedContent">
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav text-right">
                    <li class="nav-item active"><a class="nav-link" href="index.php"> السائقين <i class="far fa-address-card"></i></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="solve.php" > حل الاعتذارات<i class="far fa-calendar-times"></i></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#notification" data-toggle="modal"
                                            data-target="#notification">    <span id="not_count"></span> الأشعارات </a></li>
                    <li class="nav-item"><a class="nav-link" href="trips.php" > الرحلات <i class="fas fa-bus"></i></a>
                    </li>
                    <li class="nav-item "><a class="nav-link" href="feedback.php"> شكاوي<i class="far fa-comment-dots"></i></a></li>

                    <li class="nav-item "><span class="nav-link" > مرحبا <?php echo $uarr[1];?> </span></li>


                    <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> الخروج </a>
                    </li>


                </ul>


            </form>
        </div>
    </div>
</nav>
