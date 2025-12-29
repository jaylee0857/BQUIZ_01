<!-- cent css.css附帶的 -->
<div class="cent"> 新增主選單
</div>
<hr>
<form action="./api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td>主選單名稱</td>
            <td><input type="text" name="text" id=""></td>
        </tr>
        <tr>
            <td>選單連結網址</td>
            <td><input type="text" name="href" id="" value=""></td>
        </tr>
        <tr>
            <td><input type="submit" value="新增"><input type="reset" value="重製"></td>
            <td></td>
        </tr>
    </table>
</form>