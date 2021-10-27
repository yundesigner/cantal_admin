<?php
require_once "../connect/db_connect.php";

$sql = "UPDATE cm_consult
        SET content = '{$_POST['content']}'
        WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('상담이 수정되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";