<!-- cent css.css附帶的 -->
<div class="cent"> 
    新增最新消息
</div>
<hr>
<form action="./api/insert.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td>最新消息資料</td>
            <td>
                <textarea name="text" id=""></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="新增"><input type="reset" value="重製"></td>
            <td></td>
        </tr>
    </table>
</form>