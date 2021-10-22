<?php
require_once "../connect/db_connect.php";

$sql = "INSERT INTO cm_notice
        SET ua_id = '1',
            title = '{$_POST['title']}',
            content = '{$_POST['content']}',
            date = NOW(),
            category = '공지사항'";

$result = myQuery($sql);

echo "<script>window.alert('공지사항이 등록되었습니다.');</script>";
echo "<script>location.href='appNotice.php';</script>";