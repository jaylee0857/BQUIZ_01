<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">校園映像資料</p>
    <form method="post" action="./api/edit.php?table=<?=$do?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="68%">網站標題</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    // $rows=$Image->all();
                    $total = $Image->count();
                    $div = 3;
                    $pages = ceil($total/$div);
                    $now=$_GET['p']??1;
                    $start=($now - 1) * $div;
                    $rows=$Image->all(" limit $start, $div");
                    foreach($rows as $row):
                ?>
                <tr>
                    <td width="68%">
                        <img style="width: 100px;height: 68px;" src="./upload/<?=$row['img']?>" alt="">
                        <input type="hidden" name="id[]" value="<?=$row['id']?>">
                    </td>
                    <td width="7%"><input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=($row['sh'] == 1) ?"checked":""?>></td>
                    <td width="7%"><input type="checkbox" name="del[]" id="" value="<?=$row['id']?>"></td>
                    <td><input type="button" value="更換圖片" onclick="op('#cover','#cvr','./modal/update.php?table=<?=$do?>&id=<?=$row['id']?>')"></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        <div class="cent">
            <?php 
                // echo $pages;
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
                            value="新增校園映像資料"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <a href=""></a>
</div>

<!-- <?php
$total = $Image->count(); //總比數
$div = 3; //幾個一頁
$pages = ceil($total/$div); //共有幾頁
$now=$_GET['p'] ?? 1; // 目前在第幾頁
$start = ($now-1) * $div ;
$rows = $Image->all(" limit $start, $div");
?>
<?php 
// 目標:做出Pagination
if($now > 1){
    $prev = $now -1;
    echo "<a href='?do=$do&p=$prev'> < </a>";
}

for ($i=1; $i <= $pages; $i++) { 
    $fone_size = ($i == $now) ? "24px" : "16px";
    echo "<a style='font-size:$fone_size;' href='?do=$do&p=$i'> $i </a>";
}

if ($now < $pages) {
    $next = $now+1;
    echo "<a href='?do=$do&p=$next'> < </a>";
}

?> -->