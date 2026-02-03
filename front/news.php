<div class="di"
    style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
        <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
            <?php
                $rows = $Ad->all(['sh'=>1]);
                foreach ($rows as $row) {
                    echo "{$row['text']}";
                }
            ?>
        </marquee>
    <div style="height:32px; display:block;">
    </div>
        
    <div class="cent">最新消息區</div>
    <hr>
    <!--正中央-->
    <div>
        <?php
            $div=5;
            $now=$_GET['p'] ?? 1;
            $total=$News->count(['sh'=>1]);
            $pages=ceil($total/$div);
            $start = $div * ($now -1);
            $rows=$News->all(['sh'=>1]," limit $start,$div");
        ?>
        <ol start="<?=$start+1?>" style="list-style-type:decimal;">
        <?php
            foreach ($rows as $row) {
                echo "<li class='sswww'>";
                echo mb_substr($row['text'],0,20);
                echo "<div class='all'>".nl2br($row['text']);
                echo "</div>";
                echo "</li>";
            }
        ?>

        </ul>

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
    </div>
    <style>
        .all{
            display:none;
        }
    </style>
    <div id="alt"
        style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 300px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
    </div>
    <script>
        $(".sswww").hover(
            function () {
                $("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({ "top": $(this).offset().top - 100 })
                console.log($(this).offset().top - 50);
                $("#alt").show()
            }
        )
        $(".sswww").mouseout(
            function () {
                $("#alt").hide()
            }
        )
        $("#alt").hover(
            function () {
                $("#alt").show()

            },
            function () {
                $("#alt").hide()

            }
        )
    </script>
</div>