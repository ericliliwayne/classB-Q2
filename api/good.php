<?php
include_once "../base.php";
$type = $_POST['type'];
$id = $_POST['id'];
$news = $News->find($id);
switch ($type) {
    case '讚':
        $news['good']++;
        $Log->save(['news'=>$id,'user'=>$_SESSION['user']]);
        break;

    case '收回讚':
        $news['good']--;
        $Log->del(['news'=>$id,'user'=>$_SESSION['user']]);
        break;
}

$News->save($news);
?>