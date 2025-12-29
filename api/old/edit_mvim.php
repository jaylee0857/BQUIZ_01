<?php include "db.php" ?>
<?php 
    dd($_POST);
    foreach($_POST['id'] as $id) {
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            $Mvim->del($id);
        } else {
            $row = $Mvim->find($id);
            $row['sh'] = (isset($_POST['sh']) && in_array($_POST['sh'])) ? 1:0;
            // $Mvim->$save($row); 多了$導致錯誤 物件是沒有的
            $Mvim->save($row);
        }
    }
    to("../backend.php?do=mvim");
?>
