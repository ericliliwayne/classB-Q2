<fieldset>
<legend>目前位置 : 首頁 > 最新文章區</legend>
<table id="news">
    <tr>
        <td width="30%">標題</td>
        <td width="50%">內容</td>
        <td width="20%"></td>
    </tr>
    <?php
        $all = $News->math('count','id',['sh'=>1]);
        $div = 5;
        $pages = ceil($all/$div);
        $now = $_GET['p']??1;
        $start = ($now-1)*$div;
        $rows = $News->all(['sh'=>1]," limit $start,$div");

        foreach($rows as $row){
    ?>
    <tr>
        <td class="title clo"><?=$row['title'];?></td>
        <td>
            <span class="summary"><?=mb_substr($row['text'],0,20);?>...</span>
            <span class="full" style="display: none;"><?=nl2br($row['text']);?></span>
        </td>
        <td>
        <?php
                if(isset($_SESSION['user'])){
                    if($Log->math('count','id',['news'=>$row['id'],'user'=>$_SESSION['user']])>0){
                        echo "<a href='#' class='great' data-id='{$row['id']}'>收回讚</a>";
                    }else{
                        echo "<a href='#' class='great' data-id='{$row['id']}'>讚</a>";
                    }
                    
                }
            ?>
    </tr>
    <?php
        }
    ?>
</table>
<div>
    <?php
        if(($now-1)>0){
            echo "<a href='?do=news&p=".($now-1)."'> < </a>";
        }
        for($i=1;$i<=$pages;$i++){
            $fontsize = ($now==$i)?'24px':'18px';
            echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
        }
        if(($now+1)<=$pages){
            echo "<a href='?do=news&p=".($now+1)."'> > </a>";
        }
    ?>
</div>
</fieldset>

<script>
    $(".title").on("click",function(){
        $(this).next().children().toggle();
    });
    $(".great").on("click",function(){
        let type = $(this).text();
        let num = parseInt($(this).siblings('span').text());
        let id = $(this).data('id');
        $.post("./api/good.php",{id,type},()=>{
            if(type==='讚'){
            $(this).text('收回讚');
            $(this).siblings('span').text(num+1)
        }else{
            $(this).text('讚');
            $(this).siblings('span').text(num-1)
        }
        })
       
    })
</script>