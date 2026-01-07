<?php
include_once "db.php";
$table=$_GET['table'];
$db=${ucfirst($table)};
// dd($_FILES['img']);
//     [name] => 01B02.jpg
//     [full_path] => 01B02.jpg
//     [type] => image/jpeg
//     [tmp_name] => C:\xampp\tmp\phpC0B9.tmp
//     [error] => 0
//     [size] => 58904
if (!empty($_FILES['img'])) {
    # code...
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/{$_FILES['img']['name']}");
    $_POST['img'] = $_FILES['img']['name'];
}
dd($_POST);

$db->save($_POST);
to("../back.php?do=$table");
?>