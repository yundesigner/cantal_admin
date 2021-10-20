<?php
require_once "../connect/db_connect.php";

$sql = "UPDATE cm_user_info
        SET name = '{$_POST['name']}',
            nickname = '{$_POST['nickname']}',
            birthday = '{$_POST['birthday']}',
            phone = '{$_POST['phone']}',
            address = '{$_POST['address']}',
            address_detail = '{$_POST['address_detail']}',
            status = '{$_POST['status']}'
        WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);

header("location: {$_SERVER['HTTP_REFERER']}");