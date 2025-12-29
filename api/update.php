<?php include "db.php" ?>

<?php 
$table=$_GET['table'];
$db=${ucfirst($table)};
dd($_FILES);
if(!empty($_FILES['img']['tmp_name'])){
    // 如果不是空的
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}
$db->save($_POST);

to("../backend.php?do=$table");
?>