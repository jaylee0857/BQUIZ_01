<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息資料管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="45%">最新消息資料內容</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>

                <?php
                    $div=5;
                    $now=$_GET['p'] ?? 1;
                    $total=$News->count();
                    $pages=ceil($total/$div);
                    $start = $div * ($now -1);
                    $rows=$News->all(" limit $start,$div");
                    foreach ($rows as $row) :
                ?>
                <tr>
                    <td >
                        <textarea name="text[<?=$row['id']?>]"id=""><?=$row['text']?></textarea>
                    </td>
                    <td >
                        <input type="checkbox" name="sh[<?=$row['id']?>]" value="<?=$row['id']?>" <?=($row['sh'] == 1)?'checked':'';?>>
                    </td>
                    <td >
                        <input type="checkbox" name="del[<?=$row['id']?>]" value="<?=$row['id']?>">
                    </td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['id']?>">
                    </td>
                </tr>
                <?php
                    endforeach;                
                ?>
            </tbody>
        </table>
                <div class="cent">
            <?php
                if($now != 1){
                    $prev=$now-1;
                    echo "<a href='?do=news&p=$prev'><</a>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                    $size = $now == $i ? "24px":"16px";
                    echo "<a style='font-size:$size;' href='?do=news&p=$i'>$i</a>";
                }
                if($now < $pages){
                    $next=$now+1;
                    echo "<a href='?do=news&p=$next'>></a>";
                }
            ?>

        </div>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op('#cover','#cvr','./modal/<?=$do?>.php?table=<?=$do?>')"
                            value="新增動態文字廣告"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>