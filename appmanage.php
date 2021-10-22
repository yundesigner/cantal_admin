<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap appPage">
  <?php $navApp = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./appmanage.php" class="on">배너관리</a></li>
      <li><a href="./appNotice.php">공지관리</a></li>
      <li><a href="./appPush.php">푸쉬관리</a></li>
      <li><a href="./appComment.php">댓글관리</a></li>
    </ul>

    <div class="table_wrap">
      <a href="./appBannerEdit.php" class="btn_counsel a-edit">등록</a>
      <table class="match_table">
        <thead>
        <tr>
          <th class="no">NO</th>
          <th>이벤트제목</th>
          <th>작성일</th>
          <th>기간</th>
          <th>상태</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pageNum = 15;
        $sql = "SELECT *, DATE_FORMAT(date, '%Y.%m.%d') AS date_format FROM cm_notice WHERE category = '배너' ORDER BY id DESC";
        $result = myQuery($sql);
        $pageTotal = mysqli_num_rows($result);
        $p = $_GET['p'];
        if (empty($p)) {
          $p = 0;
        } elseif ($p < 0) {
          $p = 0;
        } elseif ($p > $pageTotal) {
          $p = $p - 15;
        }
        $sql = "SELECT *, DATE_FORMAT(date, '%Y.%m.%d') AS date_format FROM cm_notice WHERE category = '배너' ORDER BY id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
          $start_date = date_create($row['start_date']);
          $end_date = date_create($row['end_date']);
          ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td class="underbar"><a href="./appBanner.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
            <td><?= $row['date_format'] ?></td>
            <td><?= date_format($start_date, 'Y.m.d') ?>~<?= date_format($end_date, 'Y.m.d') ?></td>
            <td><?php if (date('Y-m-d') < $row['start_date']) {
                echo '예정';
              } elseif (date('Y-m-d') > $row['end_date']) {
                echo '종료';
              } else {
                echo '진행';
              }
              ?></td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/appmanage.php?p=<?php
          if ($p <= 0) {
            echo $p;
          } else {
            echo $p - 15;
          }
          ?>'>
            <li class="page-left">&lt;</li>
          </a>
          <?php
          $pages = ceil($pageTotal / $pageNum);
          $pageGroup = ceil($pages / 10);
          $pageCount = ceil(ceil($pages / $pageGroup) / 10) * 10;
          $pageEnd = ceil($pageTotal / 150) * 150 - 15;

          for ($j = 1; $j < $pageGroup + 1; $j++) {
            if ($p < 150) {
              $Count = 1;
            } elseif ($p <= $pageEnd - (150 * ($j - 1))) {
              $Count = 1 + (10 * $pageGroup) - (10 * $j);
            }
          }

          for ($i = $Count; $i - $Count < $pageCount; $i++) {
            $nextPage = $pageNum * ($i - 1);
            $activePage = $_GET['p'] / 15 + 1;
            $className = '';
            if ($activePage == $i) {
              $className = 'page-on';
            }
            echo "<a href='$_SERVER[PHP_SELF]?p=$nextPage";

            echo "'><li class='$className'>$i</li></a>";

            if ($i >= $pages) {
              $i = $pages;
              break;
            }
          }
          ?>
          <a href='/admin/appmanage.php?p=<?php
          if ($p + 15 >= $pageTotal) {
            echo $p;
          } else {
            echo $p + 15;
          }
          ?>'>
            <li class="page-right">&gt;</li>
          </a>
        </ul>
      </div>
      <!-- page -->
    </div>

  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>