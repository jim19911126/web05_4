<?php include_once "./api/db.php";

$_POST['reg_date']=date("Y-m-d");
$User->save($_POST);

?>