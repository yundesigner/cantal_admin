<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_notice WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$sql = "UPDATE cm_notice
        SET ua_id = '1',
            title = '{$_POST['title']}',
            content = '{$_POST['content']}'
        WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('공지사항이 수정되었습니다.');</script>";
echo "<script>location.href='appNoticeAdd.php?id={$_GET['id']}';</script>";