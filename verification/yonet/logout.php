<?php
session_start();
// destroying session if it exists
if(isset($_SESSION)>0) {
    session_destroy();
}
// redirecting to login page
header('Location:login.php?err=4');
