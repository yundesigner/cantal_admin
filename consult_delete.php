<?php
require_once "../connect/db_connect.php";

$sql = "DELETE FROM cm_consult WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('상담이 삭제되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";