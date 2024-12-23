<?php
require_once "class.php";
class delete_patient extends DB_con
{

}
$obj = new delete_patient();
if (isset($_POST["PID"])) {

    if ($obj->delete("patient", $_POST["PID"])) {
        header("Location:../search_patient.php");
    }
    else
        echo "Oops! Something went wrong. Please try again later or contact support for assistance.";

}?>
