<?php include_once "db.php";
$table=$_GET['table'];
unset($_GET['table']);


$chk = $$table->count($_GET);


if ($chk) {
    echo 1; //帳號已被使用
    switch ($table) {
        case 'User':
            # code...    
            $_SESSION['login'] = $_GET['acc'];
            break;
            case 'Admin':
            $_SESSION['admin'] = $_GET['acc'];
            break;
    }
    # code...
} else {
    echo 0; //帳號可使用
}

?>