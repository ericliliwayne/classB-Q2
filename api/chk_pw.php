<?php
    include_once "../base.php";

    // $acc = $_POST['acc'];
    // $chk = $User->find(['acc'=>$acc]);
    // echo $User->math('count','id',['acc'=>$acc]);
    $chk =  $User->math('count','id',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);
    if($chk){
        echo 1;
        $_SESSION['user'] = $_POST['acc'];
    }else{
        echo 0;
    }

    
?>