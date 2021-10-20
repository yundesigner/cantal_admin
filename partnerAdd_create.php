<?php
require_once "../connect/db_connect.php";

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

$sql = "INSERT INTO cm_partner
        SET name = '{$_POST['name']}',
            birthday = '{$_POST['birthday']}',
            phone = '{$_POST['phone']}',
            company_name = '{$_POST['company_name']}',
            email = '{$_POST['email']}',
            company_phone = '{$_POST['company_phone']}',
            image_path = '{$uploads_number}',
            image = '{$_FILES['upload']['name']}',
            join_date = NOW()";

$result = myQuery($sql);

echo "<script>window.alert('파트너 등록이 완료되었습니다.');</script>";
echo "<script>location.href='partner.php';</script>";