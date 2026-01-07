<?php
include_once "db.php";
$is_user = $Admin->count($_POST); 

if ($is_user) {
    to("../back.php");
}
?>
<script>
    alert("帳號或密碼輸入錯誤");
    location.href="../index.php?do=login";


</script>