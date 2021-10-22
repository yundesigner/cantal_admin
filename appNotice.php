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
        <li><a href="./appmanage.php">배너관리</a></li>
        <li><a href="./appNotice.php" class="on">공지관리</a></li>
        <li><a href="./appPush.php">푸쉬관리</a></li>
        <li><a href="./appComment.php">댓글관리</a></li>
      </ul>

      <div class="table_wrap w70">
        <a href="./appNoticeEdit.php" class="btn_counsel a-edit">등록</a>
        <table class="match_table">
          <thead>
            <tr>
              <th class="no">NO</th>
              <th>제목</th>
              <th class="w126">등록일시</th>
              <th class="w126">작성자</th>
              <th class="w126">자세히보기</th>
            </tr>
          </thead>
          <tbody>
            <?php
        $pageNum = 15;
        $sql = "SELECT n.*, ui.name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
                FROM cm_notice AS n
                JOIN cm_user_info AS ui ON n.ua_id = ui.u_id
                WHERE category = '공지사항'
                ORDER BY n.id DESC";
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
        $sql = "SELECT n.*, ui.name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
                FROM cm_notice AS n
                JOIN cm_user_info AS ui ON n.ua_id = ui.u_id
                WHERE category = '공지사항'
                ORDER BY n.id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td class="underbar"><a href="./appNoticeAdd.php"><?= $row['title'] ?></a></td>
              <td><?= $row['date_format'] ?></td>
              <td><?= $row['name'] ?></td>
              <td class="detail">
                <a href="./appNoticeAdd.php" class="btn_detail">보기</a>
              </td>
            </tr>
            <?php
        }
        ?>
          </tbody>
        </table>
        <div class="page">
          <ul>
            <a href='/admin/appNotice.php?p=<?php
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
            <a href='/admin/appNotice.php?p=<?php
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

  <script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
  <script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>