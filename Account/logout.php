<?php
session_start();
session_destroy();
header("Location: acc.php");
exit();
?>
