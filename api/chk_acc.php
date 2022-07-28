<?php
    include_once "../base.php";

    // $acc = $_POST['acc'];
    // $chk = $User->find(['acc'=>$acc]);
    // echo $User->math('count','id',['acc'=>$acc]);
    echo $User->math('count','id',['acc'=>$_POST['acc']]);
    

    
?>