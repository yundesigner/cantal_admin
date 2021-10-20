<?php
require_once "../connect/db_connect.php";

$sql = "UPDATE cm_event
        SET status = '완료'
        WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);

header("location: {$_SERVER['HTTP_REFERER']}");