<?php
require_once "../connect/db_connect.php";

if ($_GET['block'] == '0') {
  $sql = "UPDATE cm_transfer SET block = '{$_GET['block']}' WHERE id = '{$_GET['id']}'";
  $result = myQuery($sql);

  echo "<script>window.alert('차단이 해제되었습니다.');</script>";
  echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";

} else {
  $sql = "UPDATE cm_transfer SET block = '{$_GET['block']}' WHERE id = '{$_GET['id']}'";
  $result = myQuery($sql);

  echo "<script>window.alert('게시글이 차단되었습니다.');</script>";
  echo "<script>location.href='{$_SERVER['HTTP_REFERER']}';</script>";
}