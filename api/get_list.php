<?php
include_once "../base.php";
$array = ["健康新知"=>"1","菸害防制"=>"2","癌症防治"=>"3","慢性病防治"=>"4"];
$type = $array[$_GET['type']];
$rows = $News->all(['type'=>$type]);
foreach($rows as $row){
    echo "<a href='javascript:getNews({$row['id']})' style='display:block'>";
    echo $row['title'];
    echo "</a>";
}
?>