<?php include "db.php" ?>

<?php 
    $table=$_GET['table'];
    $db=${ucfirst($table)};
    if(!empty($_FILES['img']['tmp_name'])){
        // 如果不是空的
        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
        $_POST['img'] = $_FILES['img']['name'];
        // move_uploaded_file()
    }
    // $count_sh = $title->count(['sh'=>1]);

    switch ($table) {
        case 'title':
            $_POST['sh'] = ($db->count(['sh'=>1]) ==0)?1:0;
            // 注意大小寫的title變數是因為用DB所以要大寫
            break;
        case 'admin':
            break;
        default:
            $_POST['sh'] = 1;
            break;
    }

    dd($_POST);
    $db->save($_POST);

    to("../backend.php?do=$table");
?>