<?php
require_once "../connect/db_connect.php";

$uploads_number = time();
$uploads_dir = "../uploads/notice/" . $uploads_number;

if ($_FILES['upload']['tmp_name']) {
  if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir);
    if (
    move_uploaded_file(
      $_FILES['upload']['tmp_name'],
      "$uploads_dir/{$_FILES['upload']['name']}"
    )
    ) {
    }
  }

  $sql = "INSERT INTO cm_notice
          SET ua_id = '1',
              title = '{$_POST['title']}',
              content = '{$_POST['content']}',
              image_path = '{$uploads_number}',
              image = '{$_FILES['upload']['name']}',
              start_date = '{$_POST['start_date']}',
              end_date = '{$_POST['end_date']}',
              date = NOW(),
              category = '배너'";

  $result = myQuery($sql);

} else {

  $sql = "INSERT INTO cm_notice
          SET ua_id = '1',
              title = '{$_POST['title']}',
              content = '{$_POST['content']}',
              start_date = '{$_POST['start_date']}',
              end_date = '{$_POST['end_date']}',
              date = NOW(),
              category = '배너'";

  $result = myQuery($sql);
}

echo "<script>window.alert('배너가 등록되었습니다.');</script>";
echo "<script>location.href='appmanage.php';</script>";