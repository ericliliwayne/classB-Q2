
<fieldset>
    <legend>問卷管理</legend>
    <form action="./api/que.php" method="post">
    <div>
        <span class="clo">問卷名稱</span>
        <span><input type="text" name="subject" id="subject"></span>
    </div>
    <div class="clo" id="options">
        <div>選項<input type="text" name="option[]">
                <input type="button" value="更多" onclick="more()"></div>
    </div>
    <input type="submit" value="新增">
    <input type="reset" value="清空">
</form>
</fieldset>

<script>
    function more(){
        let opt = `<div>選項<input type="text" name="option[]"></div>`;
        $("#options").append(opt);
    }
</script>
