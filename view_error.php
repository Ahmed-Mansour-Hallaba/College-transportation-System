<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['error']))
{ $er=$_SESSION['error'];
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $er;?>
    </div>
    <?php unset($_SESSION['error']);}?>