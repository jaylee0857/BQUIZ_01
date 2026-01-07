<div class="cent">新增校園映像圖片</div>
<hr>
<form action="../api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <div class="cent">
        校園映像圖片：<input type="file" name="img">
    </div>
    <div class="cent">
        <input type="submit" value="新增">
        <input type="reset" value="重製">
    </div>
</form>
