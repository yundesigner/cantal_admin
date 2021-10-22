<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_inquiry WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

function rmdir_ok($dir)
{
  $dirs = dir($dir);
  while (false !== ($entry = $dirs -> read())) {
    if ($entry != "." && $entry != "..") {
      if (is_dir($dir . "/" . $entry)) {
        rmdir_ok($dir . "/" . $entry);
      } else {
        @unlink($dir . "/" . $entry);
      }
    }
  }
  $dirs -> close();
  @rmdir($dir);
}

rmdir_ok("../uploads/inquiry/" . $row['u_id'] . '/' . $row['image_path'] . '/reply');

$sql = "UPDATE cm_inquiry
        SET ua_id = NULL,
            reply_content = NULL,
            reply_image = NULL,
            reply_date = NULL,
            reply_delete_date = NOW()
        WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('답변이 삭제되었습니다.');</script>";
echo "<script>location.href='userCounselCheck.php?id={$_GET['id']}';</script>";