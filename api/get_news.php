<?php
include_once "../base.php";
$array = ["健康新知"=>"1","菸害防制"=>"2","癌症防治"=>"3","慢性病防治"=>"4"];
$id = $_GET['id'];
$news = $News->find($id);
echo nl2br($news['text']);
?>