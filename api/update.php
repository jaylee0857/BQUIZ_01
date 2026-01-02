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
// $_FILES = [
//   'img' => [
//     'name'     => 'campus_5_new.jpg',               // 原始檔案名稱
//     'type'     => 'image/jpeg',                     // MIME 類型
//     'tmp_name' => '/tmp/php3zU8sd',                 // PHP 暫存檔路徑
//     'error'    => 0,                                // 0 代表上傳成功
//     'size'     => 482131                            // 檔案大小（bytes）
//   ]
// ];
$db->save($_POST);

to("../backend.php?do=$table");
?>