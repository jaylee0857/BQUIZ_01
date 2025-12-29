<?php include "db.php" ;

// 分兩張表
//編輯
if(!empty($_POST['text'])){
    foreach($_POST['text'] as $id =>$text){
        $href=$_POST['href'][$id];
        if (!empty($_POST['del']&& in_array($id,$_POST['del']))) {
            $Menu->del($id);
        }else {
            $row=$Menu->find($id);
            $row['text']=$text;
            $row['href']=$href;
            $Menu->save($row);
        }
    }
}
//新增
// $_POST['new_text'];
// $_POST['new_href'];


if(!empty($_POST['new_text'])){
    foreach($_POST['new_text'] as $key =>$text){
        if($text !=""){
            $href=$_POST['new_href'][$key];
            $Menu->save(['main_id'=>$_GET['main_id'],
                        'text'=>$text,
                        'href'=>$href]);
        }
    }
}

// dd($_POST);
to("../backend.php?do=Menu");

?>
