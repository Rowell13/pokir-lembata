
<?php
session_start();
if ((isset($_GET["act"]))&&($_GET["act"]=="keluar"))
   {
   echo "<script>document.location.href='1_home.php?act=keluar';</script>";
   }
   else
   {
   echo "<script>document.location.href='1_home.php';</script>";
   }
session_destroy();
?>
