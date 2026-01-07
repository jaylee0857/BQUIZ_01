<?php include "db.php" ; 

//新增
dd($_POST);
if (!empty($_POST['text2'])) {
    foreach ($_POST['text2'] as $key => $text) {
        $href = $_POST['text2'][$key];
        $Menu->save(['href'=>$href,'text'=>$text,"main_id"=>$_POST['main_id']]);
    }
}


if (!empty($_POST['text'])) {
    foreach ($_POST['id'] as $key => $id) {
        if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
            $Menu->del($id);
        }else {
            $row = $Menu->find($id);
            $row['text']=$_POST['text'][$id];
            $row['href']=$_POST['href'][$id];
            $Menu->save($row);
        }
    }
}
//編輯





to("../back.php?do=menu");

?>