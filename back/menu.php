<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">網站標題管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="28%">主選單名稱</td>
                    <td width="28%">選單連結網址</td>
                    <td width="23%">次選單數</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    $rows=$Menu->all(['main_id'=>0]);
                    foreach ($rows as $row) :
                ?>
                <tr>
                    <td >
                        <input type="text" value="<?=$row['text']?>" name="text[<?=$row['id']?>]">
                    </td>
                    <td >
                        <input type="text" value="<?=$row['href']?>" name="href[<?=$row['id']?>]">
                    </td>
                    <td>
                        <?=$Menu->count(['main_id'=>$row['id']]);?>
                    </td>
                    <td >
                        <input type="checkbox" name="sh[<?=$row['id']?>]" value="<?=$row['id']?>" <?=($row['sh'] == 1)?'checked':'';?>>
                    </td>
                    <td >
                        <input type="checkbox" name="del[<?=$row['id']?>]" value="<?=$row['id']?>">
                    </td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['id']?>">
                        <input type="button"
                            onclick="op('#cover','#cvr','./modal/submenu.php?table=<?=$do?>&main_id=<?=$row['id']?>')"
                            value="編輯次選單">
                    </td>
                </tr>
                <?php
                    endforeach;                
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op('#cover','#cvr','./modal/<?=$do?>.php?table=<?=$do?>')"
                            value="新增主選單"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>