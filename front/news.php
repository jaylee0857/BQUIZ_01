<style>
	.all {
		display: none;
	}
</style>
<div class="di"
	style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
		<?php 
            $rows = $Ad->all(['sh'=>1]);
            foreach ($rows as $row){
                echo $row['text'];
            }
        ?>
	</marquee>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<h3>更多消息顯示區</h3>
	<hr>
	<?php
			$total = $News->count(['sh'=>1]);
			$div = 5;
			$pages = ceil($total/$div);
			$now=$_GET['p']??1;
			$start=($now - 1) * $div;
			$news=$News->all(['sh'=>1]," limit $start, $div");
	?>
		<!-- 重要 -->
		 <!-- 列表 -->
        <ol class="ssaa" start="<?=$start+1;?>" style="list-style-type:decimal;">
            <?php 
                foreach ($news as $new) {
                    # code...
                    echo "<li class='sswww'>";
                    echo mb_substr($new['text'],0,20);
                    echo "<div class='all'>" . nl2br($new['text']);
                    echo "<div>";
                    echo "</li>";
                }
            ?>
        </ol>
		<!-- 談窗 -->
		<div id="alt"
			style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 0px; left: 200px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
		</div>
		<script>
			$(".sswww").hover(
				function () {
					$("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({ "top": $(this).offset().top - 100 })
					$("#alt").show()
				}
			)
			$(".sswww").mouseout(
				function () {
					$("#alt").hide()
				}
			)
		</script>
		<!-- 分頁 -->
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
</div>