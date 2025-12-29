<?php include "db.php" ?>

<?php 
    dd($_FILES);
    if(!empty($_FILES['img']['tmp_name'])){
        // 如果不是空的
        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
        $_POST['img'] = $_FILES['img']['name'];
        // move_uploaded_file()
    }
    // $count_sh = $title->count(['sh'=>1]);
    $_POST['sh'] = 1;
    // 注意大小寫的title變數是因為用DB所以要大寫
    $Mvim->save($_POST);

    to("../backend.php?do=mvim");
?>