<?php include "db.php" ;
    $table=$_GET['table'];
    $db=${ucfirst($table)};
    $row = $db->find(1);
    $row[$table] = $_POST[$table];
    dd($row);
    $db->save($row);
// switch ($_GET['table']) {
//     case 'total':
//         $row = $Total->find(1);
//         $row['total'] = $_POST['total'];
//         // dd($row);
//         $Total->save($row);
//         break;
//     case 'bottom':
//         $row = $Total->find(1);
//         $row['bottom'] = $_POST['bottom'];
//         // $Total->save($row);
//         dd($row);

//         break;
//     default:
//         # code...
//         break;
// }

    to("../backend.php?do=$table");


?>
