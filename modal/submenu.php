<?php include_once "../api/db.php" ?>

<div class="cent">編輯次選單</div>
<hr>
<style>
    #box tr{
        display: flex;
        justify-content: space-between;
    }
    .ccc{
        display: flex;
        justify-content: space-between;
    }

</style>
<form action="../api/submenu.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table id="box" style="width: 65%; margin: auto;">
        <tr class="ccc">
            <td width="30%">次選單名稱</td>
            <td width="30%">次選單連結網址</td>
            <td>刪除</td>
        </tr>
        <?php 
            $main_id = $_GET['main_id'];
            $rows = $Menu->all(['main_id'=>$main_id]);
            foreach ($rows as $row) :
        ?>
        <tr>
            <td>
                <input type="text" name="text[<?=$row['id']?>]" value="<?=$row['text']?>">
            </td>
            <td>
                <input type="text" name="href[<?=$row['id']?>]" value="<?=$row['href']?>">
            </td>
            <td>
                <input type="checkbox" name="del[]" value="<?=$row['id']?>">
                <input type="hidden" name="id[]" value="<?=$row['id']?>">
            </td>
        </tr>
        <?php 
            endforeach;
        ?>

    </table>
    <div class="cent">
        <input type="submit" value="新增">
        <input type="hidden" name="main_id" value="<?=$_GET['main_id'] ?>">
        <input type="reset" value="重製">
        <input type="button" value="更多次選單" onclick="more()">
    </div>
</form>

<script>
    function more(){

        $row = `
        <tr>
        <td>
            <input type="text" name="text2[]" value="">
        </td>
        <td>
            <input type="text" name="href2[]" value="">
        </td>
        <td>
            <input type="checkbox" name="del[]">
        </td>
        </tr>

        `
        $('#box').append($row);
    }

</script>
