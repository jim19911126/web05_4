<?php include_once "db.php";


echo $User->count(['acc'=>$_GET['acc']]);

// $chk=$User->count(['acc'=>$_GET['acc']]);

// if ($chk) {
//     echo 1; //帳號已被使用
//     # code...
// }else {
//     echo 0; //帳號可使用
// }

?>