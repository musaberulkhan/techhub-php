<?php
    setcookie("LOGGEDUSER", $get_username, time() - (86400 * 30), "/");
    header("location:admin.php");
?>
