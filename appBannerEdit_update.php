<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_notice WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

if ($row['image']) {

  $uploads_dir = "../uploads/notice/" . $row['image_path'];

  if (is_dir($uploads_dir)) {
    if ($_FILES['upload']['tmp_name']) {
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
  }
}

$uploads_number = time();
$uploads_dir = "../uploads/notice/" . $uploads_number;

if (!is_dir($uploads_dir)) {
  if ($_FILES['upload']['tmp_name']) {
    mkdir($uploads_dir);
    if (
    move_uploaded_file(
      $_FILES['upload']['tmp_name'],
      "$uploads_dir/{$_FILES['upload']['name']}"
    )
    ) {
    }
  }
}

if ($_FILES['upload']['tmp_name']) {
  $sql = "UPDATE cm_notice
          SET ua_id = '1',
              title = '{$_POST['title']}',
              content = '{$_POST['content']}',
              image_path = '{$uploads_number}',
              image = '{$_FILES['upload']['name']}',
              start_date = '{$_POST['start_date']}',
              end_date = '{$_POST['end_date']}'
          WHERE id = '{$_GET['id']}'";

  $result = myQuery($sql);

} else {

  $sql = "UPDATE cm_notice
          SET ua_id = '1',
              title = '{$_POST['title']}',
              content = '{$_POST['content']}',
              start_date = '{$_POST['start_date']}',
              end_date = '{$_POST['end_date']}'
          WHERE id = '{$_GET['id']}'";

  $result = myQuery($sql);
}

echo "<script>window.alert('배너가 수정되었습니다.');</script>";
echo "<script>location.href='appBanner.php?id={$_GET['id']}';</script>";