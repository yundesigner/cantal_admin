<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_partner WHERE id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

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

  rmdir_ok("../uploads/partner/" . $row['image_path']);

  $uploads_number = time();
  $uploads_dir = "../uploads/partner/" . $uploads_number;

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

  $sql = "UPDATE cm_partner
        SET name = '{$_POST['name']}',
            birthday = '{$_POST['birthday']}',
            phone = '{$_POST['phone']}',
            company_name = '{$_POST['company_name']}',
            email = '{$_POST['email']}',
            company_phone = '{$_POST['company_phone']}',
            image_path = '{$uploads_number}',
            image = '{$_FILES['upload']['name']}'
        WHERE id = '{$_GET['id']}'";

  $result = myQuery($sql);

} else {

  $sql = "UPDATE cm_partner
        SET name = '{$_POST['name']}',
            birthday = '{$_POST['birthday']}',
            phone = '{$_POST['phone']}',
            company_name = '{$_POST['company_name']}',
            email = '{$_POST['email']}',
            company_phone = '{$_POST['company_phone']}'
        WHERE id = '{$_GET['id']}'";

  $result = myQuery($sql);
}

echo "<script>window.alert('파트너가 수정되었습니다.');</script>";
echo "<script>location.href='partner.php';</script>";