<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap userPage">
  <?php $navPartner = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./partner.php" class="on">파트너목록</a></li>
      <li><a href="./partnerAdd.php">파트너등록</a></li>
    </ul>

    <?php $search = $_GET['search']; ?>

    <div class="form_wrap">
      <form action="" class="search">
        <input type="search" placeholder="파트너이름, 연락처를 입력해주세요." class="txt_search" name="search"
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
          <th>파트너이름</th>
          <th>업체</th>
          <th>연락처</th>
          <th>이메일</th>
          <th>매칭배차</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pageNum = 15;
        $sql = "SELECT p.*, IFNULL(m.count, 0) AS count
                FROM cm_partner AS p
                LEFT JOIN (SELECT p_id, COUNT(p_id) AS count
                           FROM cm_matching
                           GROUP BY p_id) AS m ON p.id = m.p_id
                ORDER BY p.id DESC";
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
        $sql = "SELECT p.*, IFNULL(m.count, 0) AS count
                FROM cm_partner AS p
                LEFT JOIN (SELECT p_id, COUNT(p_id) AS count
                           FROM cm_matching
                           GROUP BY p_id) AS m ON p.id = m.p_id
                ORDER BY p.id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        if ($search) {
          $pageNum = 15;
          $sql = "SELECT p.*, IFNULL(m.count, 0) AS count
                  FROM cm_partner AS p
                  LEFT JOIN (SELECT p_id, COUNT(p_id) AS count
                             FROM cm_matching
                             GROUP BY p_id) AS m ON p.id = m.p_id
                  WHERE p.name LIKE '%{$search}%' OR p.company_name LIKE '%{$search}%' OR p.phone LIKE '%{$search}%' OR p.email LIKE '%{$search}%'
                  ORDER BY p.id DESC";
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
          $sql = "SELECT p.*, IFNULL(m.count, 0) AS count
                  FROM cm_partner AS p
                  LEFT JOIN (SELECT p_id, COUNT(p_id) AS count
                             FROM cm_matching
                             GROUP BY p_id) AS m ON p.id = m.p_id
                  WHERE p.name LIKE '%{$search}%' OR p.company_name LIKE '%{$search}%' OR p.phone LIKE '%{$search}%' OR p.email LIKE '%{$search}%'
                  ORDER BY p.id DESC LIMIT {$p}, {$pageNum}";
          $result = myQuery($sql);
        }

        while ($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td class="underbar"><a href="./partnerList.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
            <td><?= $row['company_name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['count'] ?>개</td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/partner.php?p=<?php
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
          <a href='/admin/partner.php?p=<?php
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

<script type="text/javascript" src="js/app.js"></script>
</body>

</html>