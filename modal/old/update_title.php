<!-- cent css.css附帶的 -->
<div class="cent"> 
    更新標題區圖片
</div>
<hr>
<form action="./api/update.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td>標題區圖片</td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?=$_GET['id']?>"><input type="submit" value="更新"><input type="reset" value="重製"></td>
            <td></td>

        </tr>
    </table>
</form>