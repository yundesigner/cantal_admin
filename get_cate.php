<?php
require_once "../connect/db_connect.php";

if ($_GET['type'] == '1') {

  $sql = "SELECT company_name FROM cm_partner GROUP BY company_name ORDER BY company_name ASC";
  $result = myQuery($sql);

  for ($i = 0; $row = mysqli_fetch_array($result); $i++) {
    ?>
    <option value="<?= $row['company_name'] ?>"><?= $row['company_name'] ?></option>
  <? } ?>
<? } ?>

<? if ($_GET['type'] == '2') {

  $sql = "SELECT name FROM cm_partner WHERE company_name = '{$_GET['company']}' ORDER BY name ASC";
  $result = myQuery($sql);
  ?>
  <option value="">파트너 선택</option>
  <?
  for ($i = 0; $row = mysqli_fetch_array($result); $i++) {
    ?>
    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
  <? } ?>
<? } ?>