<?php include "db.php" ?>

<?php 
    $_POST['sh']=1;
    $Ad->save($_POST);

    to("../backend.php?do=ad");
?>