<?php
include_once "db.php";
$table=$_GET['table'];
$db=${ucfirst($table)};
$id=$_GET['id'];
dd($_POST);
                
$row = $db->find(1);
$row[$table]=$_POST[$table];
$db->save($row);


to("../back.php?do=$table");
?>