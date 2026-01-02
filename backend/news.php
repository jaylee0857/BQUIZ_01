<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">替代文字</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    // $rows=$News->all();
                    $total = $News->count();
                    $div = 5;
                    $pages = ceil($total/$div);
                    $now=$_GET['p']??1;
                    $start=($now - 1) * $div;
                    $rows=$News->all(" limit $start, $div");
                    foreach($rows as $row):
                ?>
                <tr>
                    <td width="80%">
                        <textarea style="width:90%" rows="5" cols="33" name="text[<?=$row['id']?>]"><?=$row['text']?></textarea>
                    </td>
                    <td width="10%"><input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=($row['sh'] == 1) ?"checked":""?>></td>
                    <td width="10%"><input type="checkbox" name="del[]" id="" value="<?=$row['id']?>"></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        <div class="cent">
            <?php 
                if ($now > 1){
                    $prev=$now-1;
                    echo "<a href='?do=$do&p=$prev'> < </a>";
                }
                for ($i=1; $i <= $pages; $i++) { 
                    $size = ($i==$now)?"24px":"16px";
                    echo "<a style='font-size:$size;' href='?do=$do&p=$i'> $i </a>";
                } 

                if ($now < $pages){
                    $next=$now+1;
                    echo "<a href='?do=$do&p=$next'> > </a>";
                }
            ?>
        </div>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                    onclick="op('#cover','#cvr','./modal/<?=$do?>.php?table=<?=$do?>')"
                    value="新增最新消息"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>