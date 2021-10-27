<?php
require_once "../connect/db_connect.php";

if ($_GET['type'] == '1') {

  $sql = "SELECT name FROM cm_partner WHERE company_name = '{$_GET['company']}' ORDER BY name ASC";
  $result = myQuery($sql);
  ?>
  <option value="">파트너 선택</option>
  <?php
  while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
    <?php
  }
}

if ($_GET['type'] == '2') {

  $sql = "SELECT phone FROM cm_partner WHERE company_name = '{$_GET['company']}' AND name = '{$_GET['p_name']}'";
  $result = myQuery($sql);
  ?>
  <option value="">연락처 선택</option>
  <?php
  while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?= $row['phone'] ?>"><?= $row['phone'] ?></option>
    <?php
  }
}
