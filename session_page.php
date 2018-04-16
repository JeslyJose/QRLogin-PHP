<?php
session_start();
$tagid=$_GET['tagid'];
if(isset($tagid))
{
 $_SESSION['tag']=$tagid;
 echo "<script>window.location.href='welcome.php' </script>";
    
}