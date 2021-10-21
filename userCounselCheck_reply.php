<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_inquiry WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$image = implode(',', $_FILES['upload']['name']);

$uploads_dir = "../uploads/inquiry/" . $row['u_id'] . '/' . $row['image_path'] . '/reply';

if (is_dir($uploads_dir)) {
  if ($_FILES['upload']['tmp_name'][0]) {
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
  }
}

if (!is_dir($uploads_dir)) {
  mkdir($uploads_dir);
  for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
    $upload_file = $_FILES['upload']['name'][$i];
    if (
    move_uploaded_file(
      $_FILES['upload']['tmp_name'][$i],
      "$uploads_dir/{$_FILES['upload']['name'][$i]}"
    )
    ) {
    }
  }
}

$sql = "UPDATE cm_inquiry
        SET ua_id = '1',
            reply_content = '{$_POST['reply_content']}',
            reply_image = '{$image}',
            reply_date = NOW()
        WHERE id = '{$_GET['id']}'";

$result = myQuery($sql);

  echo "<script>window.alert('답변 등록이 완료되었습니다.');</script>";
  echo "<script>location.href='userCounselCheck.php?id={$_GET['id']}';</script>";