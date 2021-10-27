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
      <li><a href="./index.php" class="on">매칭현황</a></li>
      <li><a href="./transfer.php">게시물 관리</a></li>
    </ul>

    <?php $search = $_GET['search']; ?>
    <?php $sort = $_GET['sort']; ?>

    <div class="form_wrap">
      <form action="index.php" method="get" class="df">
        <div class="search">
          <input type="search" placeholder="고객이름, 제품명을 입력해주세요." class="txt_search" name="search"
                 value="<?= $search ?>" />
          <input type="submit" value="" class="btn_search" />
        </div>
        <div class="radio">
          <p>진행현황</p>
          <input type="radio" id="all" name="sort" value="" checked />
          <label for="all">전체</label>
          <input type="radio" id="wait" name="sort" value="대기" <?php if ($_GET['sort'] === "대기") {
            echo "checked";
          } ?> />
          <label for="wait">대기</label>
          <input type="radio" id="complete" name="sort" value="완료" <?php if ($_GET['sort'] === "완료") {
            echo "checked";
          } ?> />
          <label for="complete">완료</label>
          <input type="radio" id="cancel" name="sort" value="취소" <?php if ($_GET['sort'] === "취소") {
            echo "checked";
          } ?> />
          <label for="cancel">취소</label>
        </div>
      </form>
    </div>
    <!-- form_wrap -->

    <div class="table_wrap">
      <table class="match_table">
        <thead>
        <tr>
          <th class="no">NO</th>
          <th>작성자</th>
          <th>신청자</th>
          <th>매칭날짜</th>
          <th>제품명</th>
          <th>파트너</th>
          <th>진행현황</th>
          <th class="detail">상세보기</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pageNum = 15;
        $sql = "SELECT * FROM
                (SELECT m.id, t.u_id AS t_id, m.u_id AS m_id, m.p_id, ui.name, t.product_name, m.status,
                DATE_FORMAT(m.date, '%Y.%m.%d') AS date_format,
                (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                (SELECT name FROM cm_partner AS p WHERE m.p_id = p.id) AS p_name
                FROM cm_transfer AS t
                JOIN cm_matching AS m ON t.id = m.t_id
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
                (SELECT m.id, t.u_id AS t_id, m.u_id AS m_id, m.p_id, ui.name, t.product_name, m.status,
                DATE_FORMAT(m.date, '%Y.%m.%d') AS date_format,
                (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                (SELECT name FROM cm_partner AS p WHERE m.p_id = p.id) AS p_name
                FROM cm_transfer AS t
                JOIN cm_matching AS m ON t.id = m.t_id
                JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub 
                ORDER BY id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        if ($search || $sort) {
          $pageNum = 15;
          $sql = "SELECT * FROM
                  (SELECT m.id, t.u_id AS t_id, m.u_id AS m_id, m.p_id, ui.name, t.product_name, m.status,
                  DATE_FORMAT(m.date, '%Y.%m.%d') AS date_format,
                  (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                  (SELECT name FROM cm_partner AS p WHERE m.p_id = p.id) AS p_name
                  FROM cm_transfer AS t
                  JOIN cm_matching AS m ON t.id = m.t_id
                  JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub 
                  WHERE (name LIKE '%{$search}%' OR m_name LIKE '%{$search}%' OR p_name LIKE '%{$search}%' OR product_name LIKE '%{$search}%') AND status LIKE '%{$sort}%'
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
                  (SELECT m.id, t.u_id AS t_id, m.u_id AS m_id, m.p_id, ui.name, t.product_name, m.status,
                  DATE_FORMAT(m.date, '%Y.%m.%d') AS date_format,
                  (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                  (SELECT name FROM cm_partner AS p WHERE m.p_id = p.id) AS p_name
                  FROM cm_transfer AS t
                  JOIN cm_matching AS m ON t.id = m.t_id
                  JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS sub 
                  WHERE (name LIKE '%{$search}%' OR m_name LIKE '%{$search}%' OR p_name LIKE '%{$search}%' OR product_name LIKE '%{$search}%') AND status LIKE '%{$sort}%'
                  ORDER BY id DESC LIMIT {$p}, {$pageNum}";
          $result = myQuery($sql);
        }

        while ($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td class="underbar"><a href="./userList.php?id=<?= $row['t_id'] ?>"><?= $row['name'] ?></a></td>
            <td class="underbar"><a href="./userList.php?id=<?= $row['m_id'] ?>"><?= $row['m_name'] ?></a></td>
            <td><?= $row['date_format'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td class="underbar"><a href="./partnerList.php?id=<?= $row['p_id'] ?>"><?= $row['p_name'] ?></a></td>
            <td><?= $row['status'] ?></td>
            <td class="detail">
              <a href="match.php?id=<?= $row['id'] ?>">
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
          <a href='/admin/index.php?p=<?php
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
          <a href='/admin/index.php?p=<?php
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
    <img src="./images/logo.png" alt="logo">
    <form>
      <div class="login-form">
        <input type='text' placeholder='아이디' value='' name='loginId'>
      </div>
      <div class="login-form">
        <input type='password' placeholder='비밀번호' value='' name='loginPw'>
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