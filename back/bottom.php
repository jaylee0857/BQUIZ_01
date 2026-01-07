<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">頁尾版權管理</p>
    <form method="post" action="./api/edit_c.php?table=<?=$do?>">
        <table width="70%" style="margin:auto">
            <?php
                $row=${ucfirst($do)}->find(1);
            ?>
            <tbody>
                <tr class="yel">
                    <td width="25%">頁尾版權資料:</td>
                    <td width="23%">
                        <input type="text" name="<?=$do?>" value="<?=$row[$do]?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>