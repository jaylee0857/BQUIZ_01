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
        <div style="height:32px; display:block;"></div>
        <!--正中央-->
        <div style="width:100%; padding:2px; height:290px;">
            <div id="mwww" loop="true" style="width:100%; height:100%;">
                <div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
            </div>
        </div>
        <script>
            var lin = new Array();
            <?php
                 $rows = $Mvim->all(['sh'=>1]);
                 //  dd($rows);
                 foreach ($rows as $row) {
                     echo "lin.push('./upload/{$row['img']}');";
                    }
                    ?>
            var now = 0;
            if (lin.length > 1) {
                setInterval("ww()", 3000);
            }
            function ww() {
                console.log(lin[now]);
                $("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>")
                //$("#mwww").attr("src",lin[now])
                now++;
                if (now >= lin.length)
                    now = 0;
            }
            ww();
        </script>
    <style>
        .all{
            display:none;
        }
    </style>
        <div
            style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
            <span class="t botli">最新消息區
                <?php 
                    if ($News->count(['sh'=>1]) > 5) {
                        echo "<a style='float:right;' href='index.php?do=news'>More...</a>";
                    }
                
                ?>
            </span>
            <ul class="ssaa" style="list-style-type:decimal;">
                <?php
                    $rows = $News->all(['sh'=>1]," limit 5");
                    foreach ($rows as $row) {
                        echo "<li>".mb_substr($row['text'],0,20);
                        echo "<div class='all'>";
                        echo $row['text'];
                        echo "</div>";
                        echo "</li>";
                    }
                ?>
            </ul>
            <div id="altt"
                style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
            </div>
            <script>
                $(".ssaa li").hover(
                    function () {
                        $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
                        $("#altt").show()
                    }
                )
                $(".ssaa li").mouseout(
                    function () {
                        $("#altt").hide()
                    }
                )
            </script>
        </div>
    </div>