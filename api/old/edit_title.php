<?php include "db.php" ?>
<?php 
    dd($_POST);
    foreach($_POST['text'] as $id => $text) {
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            $Title->del($id);
        } else {
            $row = $Title->find($id);
            $row['text']=$text;
            $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1:0;
            // $Title->$save($row); 多了$導致錯誤 物件是沒有的
            $Title->save($row);
        }
    }
    to("../backend.php?do=title");
?>
