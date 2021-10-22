<?php
require_once "../connect/db_connect.php";

$sql = "DELETE FROM cm_notice WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('공지사항이 삭제되었습니다.');</script>";
echo "<script>location.href='appNotice.php';</script>";