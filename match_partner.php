<?php
require_once "../connect/db_connect.php";

$sql = "SELECT id FROM cm_partner WHERE company_name = '{$_POST['company']}' AND name = '{$_POST['p_name']}' AND phone = '{$_POST['p_phone']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$sql = "UPDATE cm_matching SET p_id = '{$row['id']}' WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);

echo "<script>window.alert('파트너가 등록되었습니다.');</script>";
echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";