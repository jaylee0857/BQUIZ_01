<div class="cent">新增最新消息資料</div>
<hr>
<form action="../api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <div class="cent">
        動態文字廣告：<textarea name="text" id=""></textarea>
    </div>
    <div class="cent">
        <input type="submit" value="新增">
        <input type="reset" value="重製">
    </div>
</form>
