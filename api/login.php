<?php include "db.php" ;

dd($_POST);

$check=$Admin->count($_POST);

if($check){
    $_SESSION['admin']=$_POST['acc'];
    to("../backend.php");
};
// $_POST['acc'];
// $_POST['pw'];
?>
<script>
    alert("帳號或是密碼錯誤, 請重新登入");
    location.href="../login.php";
</script>