<?php
session_start();
$_SESSION["user"]=null;
session_destroy();
echo $_SESSION["user"];
    header("location:homepage.php");

?>  
