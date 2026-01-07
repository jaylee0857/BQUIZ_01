<div class="cent">新增標題區圖片</div>
<hr>
<form action="../api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <div class="cent">
        帳號：<input type="text" name="acc">
    </div>
    <div class="cent">
        密碼：<input type="password" name="pw">
    </div>
    <div class="cent">
        確認密碼：<input type="password" >
    </div>
    <div class="cent">
        <input type="submit" value="新增">
        <input type="reset" value="重製">
    </div>
</form>
