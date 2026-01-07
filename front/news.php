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
    asd
</div>