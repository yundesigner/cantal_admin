<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap indexPage">
  <?php $navIndex = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./index.php">매칭현황</a></li>
      <li><a href="./transfer.php" class="on">게시물 관리</a></li>
    </ul>

    <?php $search = $_GET['search']; ?>

    <div class="form_wrap">
      <form action="transfer.php" method="get" class="search">
        <input type="search" placeholder="고객이름, 제품명을 입력해주세요." class="txt_search" name="search"
               value="<?= $search ?>" />
        <input type="submit" value="" class="btn_search" />
      </form>
    </div>
    <!-- form_wrap -->

    <div class="table_wrap">
      <table class="match_table">
        <thead>
        <tr>
          <th class="no">NO</th>
          <th>작성자</th>
          <th>작성날짜</th>
          <th>제품명</th>
          <th>신고현황</th>
          <th>게시글 상태</th>
          <th class="detail">상세보기</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pageNum = 15;
        $sql = "SELECT * FROM
                (SELECT t.id, t.u_id, ui.name, t.product_name, t.block,
                DATE_FORMAT(t.date, '%Y.%m.%d') AS date_format,
                (SELECT COUNT(*) FROM cm_transfer_report WHERE t.id = t_id) AS count
                FROM cm_transfer AS t
                JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub
                ORDER BY id DESC";
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
        $sql = "SELECT * FROM
                (SELECT t.id, t.u_id, ui.name, t.product_name, t.block,
                DATE_FORMAT(t.date, '%Y.%m.%d') AS date_format,
                (SELECT COUNT(*) FROM cm_transfer_report WHERE t.id = t_id) AS count
                FROM cm_transfer AS t
                JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub
                ORDER BY id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        if ($search) {
          $pageNum = 15;
          $sql = "SELECT * FROM
                  (SELECT t.id, t.u_id, ui.name, t.product_name, t.block,
                  DATE_FORMAT(t.date, '%Y.%m.%d') AS date_format,
                  (SELECT COUNT(*) FROM cm_transfer_report WHERE t.id = t_id) AS count
                  FROM cm_transfer AS t
                  JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub
                  WHERE name LIKE '%{$search}%' OR product_name LIKE '%{$search}%'
                  ORDER BY id DESC";
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
          $sql = "SELECT * FROM
                  (SELECT t.id, t.u_id, ui.name, t.product_name, t.block,
                  DATE_FORMAT(t.date, '%Y.%m.%d') AS date_format,
                  (SELECT COUNT(*) FROM cm_transfer_report WHERE t.id = t_id) AS count
                  FROM cm_transfer AS t
                  JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub
                  WHERE name LIKE '%{$search}%' OR product_name LIKE '%{$search}%'
                  ORDER BY id DESC LIMIT {$p}, {$pageNum}";
          $result = myQuery($sql);
        }

        while ($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td class="underbar"><a href="./userList.php?id=<?= $row['u_id'] ?>"><?= $row['name'] ?></a></td>
            <td><?= $row['date_format'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?php
              if ($row['count'] == 0) {
                echo '-';
              } else {
                echo "신고 {$row['count']}건";
              } ?></td>
            <td><?php
              if ($row['block'] == 0) {
                echo '-';
              } else {
                echo '차단';
              } ?></td>
            <td class="detail">
              <a href="transferDetail.php?id=<?= $row['id'] ?>">
                <div class="btn_detail">보기</div>
              </a>
            </td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/transfer.php?p=<?php
          if ($p <= 0) {
            echo $p;
          } else {
            echo $p - 15;
          }
          if (isset($_GET['search'])) {
            echo "&search=$search";
          } else {
            echo "";
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
            if (isset($_GET["search"])) {
              echo "&search=$search";
            } else {
              echo "";
            }
            echo "'><li class='$className'>$i</li></a>";

            if ($i >= $pages) {
              $i = $pages;
              break;
            }
          }
          ?>
          <a href='/admin/transfer.php?p=<?php
          if ($p + 15 >= $pageTotal) {
            echo $p;
          } else {
            echo $p + 15;
          }
          if (isset($_GET['search'])) {
            echo "&search=$search";
          } else {
            echo "";
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

<div class="login">
  <div class="login_in">
    <img src="./images/logo.png" alt="logo"></img>
    <form>
      <div class="login-form">
        <input type='text' placeholder='아이디' value='' name='loginId'></input>
      </div>
      <div class="login-form">
        <input type='password' placeholder='비밀번호' value='' name='loginPw'></input>
      </div>
      <div class="left">
        <input type="checkbox" name="checker" id="login" />
        <label for="login">자동 로그인</label>
      </div>
      <div class="blue-btn" onclick="login()">로그인하기</div>
    </form>
  </div>
</div>

<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>