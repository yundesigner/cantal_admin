<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_notice WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

if ($row['image']) {
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

  rmdir_ok("../uploads/notice/" . $row['image_path']);
}

$sql = "DELETE FROM cm_notice WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

echo "<script>window.alert('배너가 삭제되었습니다.');</script>";
echo "<script>location.href='appmanage.php';</script>";