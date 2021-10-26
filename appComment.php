<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap appCommentPage">
  <?php $navApp = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./appmanage.php">배너관리</a></li>
      <li><a href="./appNotice.php">공지관리</a></li>
      <li><a href="./appPush.php">푸쉬관리</a></li>
      <li><a href="./appComment.php" class="on">댓글관리</a></li>
    </ul>

    <div class="table_wrap">
      <table class="match_table">
        <thead>
        <tr>
          <th>등록시간</th>
          <th>댓글작성자</th>
          <th>게시글제목</th>
          <th class="w50">댓글</th>
          <th>차단</th>
          <th>신고현황</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $confirm_1 = "'댓글을 차단하시겠습니까?'";
        $confirm_0 = "'차단을 해제하시겠습니까?'";
        $pageNum = 5;
        $sql = "SELECT r.*, ui.name,
                (SELECT title FROM cm_transfer AS t WHERE r.t_id = t.id) AS title,
                (SELECT COUNT(*) FROM cm_transfer_report WHERE r.id = r_id) AS count
                FROM cm_reply AS r
                JOIN cm_user_info AS ui ON r.u_id = ui.u_id
                ORDER BY r.id DESC";
        $result = myQuery($sql);
        $pageTotal = mysqli_num_rows($result);
        $p = $_GET['p'];
        if (empty($p)) {
          $p = 0;
        } elseif ($p < 0) {
          $p = 0;
        } elseif ($p > $pageTotal) {
          $p = $p - 5;
        }
        $sql = "SELECT r.*, ui.name,
                (SELECT title FROM cm_transfer AS t WHERE r.t_id = t.id) AS title,
                (SELECT COUNT(*) FROM cm_transfer_report WHERE r.id = r_id) AS count
                FROM cm_reply AS r
                JOIN cm_user_info AS ui ON r.u_id = ui.u_id
                ORDER BY r.id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
          $date = date_create($row['date']);
          ?>
          <tr>
            <td class="lh18"><?= date_format($date, "Y.m.d") ?><br /><?= date_format($date, "H:i:s") ?></td>
            <td class="underbar"><a href="userList.php?id=<?= $row['u_id'] ?>"><?= $row['name'] ?></a></td>
            <td class="underbar"><a href="transferDetail.php?id=<?= $row['t_id'] ?>"><?= $row['title'] ?></a></td>
            <td><?= $row['content'] ?></td>
            <td><?php
              if ($row['block'] == 0) {
                echo '<button class="block"><a href="replyBlock.php?id=' . $row['id'] . '&block=1" onclick="return confirm(' . $confirm_1 . ');" style="color: #fff">차단</a></button>';
              } else {
                echo '<button class="block cancel"><a href="replyBlock.php?id=' . $row['id'] . '&block=0" onclick="return confirm(' . $confirm_0 . ');" style="color: #fff">해제</a></button>';
              }
              ?></td>
            <td><?= $row['count'] ?>건</td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/appComment.php?p=<?php
          if ($p <= 0) {
            echo $p;
          } else {
            echo $p - 5;
          }
          ?>'>
            <li class="page-left">&lt;</li>
          </a>
          <?php
          $pages = ceil($pageTotal / $pageNum);
          $pageGroup = ceil($pages / 10);
          $pageCount = ceil(ceil($pages / $pageGroup) / 10) * 10;
          $pageEnd = ceil($pageTotal / 50) * 50 - 5;

          for ($j = 1; $j < $pageGroup + 1; $j++) {
            if ($p < 50) {
              $Count = 1;
            } elseif ($p <= $pageEnd - (50 * ($j - 1))) {
              $Count = 1 + (10 * $pageGroup) - (10 * $j);
            }
          }

          for ($i = $Count; $i - $Count < $pageCount; $i++) {
            $nextPage = $pageNum * ($i - 1);
            $activePage = $_GET['p'] / 5 + 1;
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
          <a href='/admin/appComment.php?p=<?php
          if ($p + 5 >= $pageTotal) {
            echo $p;
          } else {
            echo $p + 5;
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