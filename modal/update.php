<!-- cent css.css附帶的 -->
 <?php 
    switch ($_GET['table']) {
        case 'title':
            $title = "更新標題區圖片";
            $header="標題區圖片";
            break;
        case 'image':
            $title = "更新標題區圖片";
            $header="標題區圖片";
            break;
        case 'mvim':
            $title = "更新標題區圖片";
            $header="標題區圖片";
            break;
    }
 
 ?>
<div class="cent"> 
    <!-- 更新標題區圖片 -->
     <?=$title?>
</div>
<hr>
<form action="./api/update.php?table=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td><?=$header?></td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?=$_GET['id']?>"><input type="submit" value="更新"><input type="reset" value="重製"></td>
            <td></td>

        </tr>
    </table>
</form>