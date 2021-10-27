<?php
require_once "../connect/db_connect.php";

$sql = "INSERT INTO cm_business_status
        SET m_id = '{$_GET['id']}',
            category = '{$_POST['category']}',
            memo = '{$_POST['memo']}',
            date = NOW()";

$result = myQuery($sql);

echo "<script>window.alert('업무가 등록되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";