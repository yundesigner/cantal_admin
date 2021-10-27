<?php
require_once "../connect/db_connect.php";

$sql = "UPDATE cm_matching SET status = '{$_POST['match_status']}' WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);

echo "<script>window.alert('매칭현황이 수정되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";