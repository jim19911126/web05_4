<?php include_once "db.php";

$_POST['reg_date']=date("Y-m-d");
$User->save($_POST);

?>