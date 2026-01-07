<div class="cent">新增標題區圖片</div>
<hr>
<form action="../api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <div class="cent">
        主選單名稱：<input type="text" name="text">
    </div>
    <div class="cent">
        主選單連結網址：<input type="text" name="href">
    </div>
    <div class="cent">
        <input type="submit" value="新增">
        <input type="reset" value="重製">
    </div>
</form>
