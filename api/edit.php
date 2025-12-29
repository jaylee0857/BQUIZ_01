<?php include "db.php" ?>
<?php 

    $table=$_GET['table'];
    $db=${ucfirst($table)};

    $ids=[];
    switch ($table) {
        case 'mvim':
        case 'image':
            $ids=$_POST['id'];
            break;
        case 'admin':
            $ids=array_keys($_POST['acc']);
            break;
        default:
            $ids=array_keys($_POST['text']);
            break;
    }

    foreach($ids as $id ) {
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            $db->del($id);
        } else {
            $row = $db->find($id);

            switch ($table) {
                case 'admin':
                    $row['acc']=$_POST['acc'][$id];
                    $row['pw']=$_POST['pw'][$id];
                    break;
                case 'menu':
                    $row['text']=$_POST['text'][$id];
                    $row['href']=$_POST['href'][$id];
                    $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
                    break;
                case 'title':
                        $row['text'] =$_POST['text'][$id];
                        $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1:0;
                    break;
                    
                case 'image':
                case 'mvim':
                        $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
                    break;
                default:
                    $row['text'] =$_POST['text'][$id];
                    $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
                    break;
            }
            // $row['text']=$text;
            // dd($row);
            // $db->$save($row); 多了$導致錯誤 物件是沒有的
            $db->save($row);
        }
    }
    to("../backend.php?do=$table");
?>
