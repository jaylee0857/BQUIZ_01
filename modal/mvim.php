<!-- cent css.css附帶的 -->
<div class="cent"> 
    新增動畫圖片
</div>
<hr>
<form action="./api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td>動畫圖片</td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        <tr>
            <td><input type="submit" value="新增"><input type="reset" value="重製"></td>
            <td></td>
        </tr>
    </table>
</form>