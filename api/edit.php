<?php
include_once "db.php";
$table=$_GET['table'];
$db=${ucfirst($table)};

dd($_POST);

foreach ($_POST['id'] as $key => $id) {
    if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
        $db->del($id);
    }else{
        $row = $db->find($id);
        switch ($table) {
            case 'title':
                $row['text'] = $_POST['text'][$id];
                $row['sh'] = ($_POST['sh'] == $id) ? 1:0;
                break;
            case 'admin':
                $row['acc']=$_POST['acc'][$id];
                $row['pw']=$_POST['pw'][$id];

                break;
            case 'mvim':
            case 'image':
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
                break;
            case 'menu':
                $row['href'] = $_POST['href'][$id];
                $row['text'] = $_POST['text'][$id];
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
                break;
            default:
                $row['text'] = $_POST['text'][$id];
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;

                break;
        }
        $db->save($row);
    }
}




to("../back.php?do=$table");
?>