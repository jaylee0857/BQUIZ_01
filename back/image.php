<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">校園映像資料管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="65%">校園映像資料圖片</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    $div=3;
                    $now=$_GET['p'] ?? 1;
                    $total=$Image->count();
                    $pages=ceil($total/$div);
                    $start = $div * ($now -1);
                    $rows=$Image->all(" limit $start,$div");
                    foreach ($rows as $row) :
                ?>
                <tr>
                    <td >
                        <img width="120px" height="80px" src="../upload/<?=$row['img']?>" alt="" name="img[<?=$row['id']?>]">
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
                            onclick="op('#cover','#cvr','./modal/update.php?table=<?=$do?>&id=<?=$row['id']?>')"
                            value="更新圖片">
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
                    echo "<a href='?do=image&p=$prev'><</a>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                    $size = $now == $i ? "24px":"16px";
                    echo "<a style='font-size:$size;' href='?do=image&p=$i'>$i</a>";
                }
                if($now < $pages){
                    $next=$now+1;
                    echo "<a href='?do=image&p=$next'>></a>";
                }
            ?>

        </div>


        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op('#cover','#cvr','./modal/<?=$do?>.php?table=<?=$do?>')"
                            value="新增動畫圖片"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>