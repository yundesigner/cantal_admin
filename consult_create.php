<?php
require_once "../connect/db_connect.php";

$sql = "INSERT INTO cm_consult
        SET u_id = '{$_POST['u_id']}',
            ua_id = '1',
            m_id = '{$_GET['id']}',
            category = '{$_POST['category']}',
            content = '{$_POST['content']}',
            date = NOW()";

$result = myQuery($sql);

echo "<script>window.alert('상담이 등록되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";