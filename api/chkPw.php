<?php include_once "db.php";


$chk=$User->count($_GET);


if ($chk) {
    echo 1; //帳號已被使用
    $_SESSION['login']=$_GET['acc'];
    # code...
}else {
    echo 0; //帳號可使用
}

?>