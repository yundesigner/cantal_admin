<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap partnerAddPage">
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
    <div class="df">
      <table class="user_info">
        <thead>
        <tr>
          <th>이름</th>
          <th>생년월일</th>
          <th>휴대폰번호</th>
          <th>업체이름</th>
          <th>이메일</th>
          <th>업체대표번호</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM cm_partner WHERE id = '{$_GET['id']}'";
        $result = myQuery($sql);
        $row = mysqli_fetch_array($result);
        ?>
        <tr>
          <td><?= $row['name'] ?></td>
          <td><?= $row['birthday'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><?= $row['company_name'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['company_phone'] ?></td>
        </tr>
        </tbody>
      </table>

      <table class="user_info partner_picture">
        <thead>
        <tr>
          <th>사진</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ml-26"><img src="../uploads/partner/<?= $row['image_path'] . '/' . $row['image'] ?>"></td>
        </tr>
        </tbody>
      </table>
    </div>

    <div class="array">
      <button class="modal_close del"><a href="partnerAdd_delete.php?id=<?= $_GET['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a></button>
      <button class="modal_close"><a href="partnerAdd.php?id=<?= $_GET['id'] ?>">수정</a></button>
    </div>

    <div class="user_active">
      <h2 class="content_title">업무현황</h2>
      <table>
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>메모</th>
          <th>작성자</th>
          <th>양도자</th>
          <th>업무시간</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pageNum = 10;
        $sql = "SELECT bs.*, t.title,
                       (SELECT name FROM cm_user_info AS ui WHERE t.u_id = ui.u_id) AS t_name,
                       (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                       DATE_FORMAT(bs.date, '%Y.%m.%d %H:%i') AS date_format
                FROM cm_business_status AS bs 
                JOIN cm_matching AS m ON bs.m_id = m.id
                LEFT JOIN cm_partner AS p ON m.p_id = p.id
                LEFT JOIN cm_transfer AS t ON m.t_id = t.id
                WHERE p.id = '{$_GET['id']}'
                ORDER BY bs.id DESC";
        $result = myQuery($sql);
        $pageTotal = mysqli_num_rows($result);
        $p = $_GET['p'];
        if (empty($p)) {
          $p = 0;
        } elseif ($p < 0) {
          $p = 0;
        } elseif ($p > $pageTotal) {
          $p = $p - 10;
        }
        $sql = "SELECT bs.*, t.title,
                       (SELECT name FROM cm_user_info AS ui WHERE t.u_id = ui.u_id) AS t_name,
                       (SELECT name FROM cm_user_info AS ui WHERE m.u_id = ui.u_id) AS m_name,
                       DATE_FORMAT(bs.date, '%Y.%m.%d %H:%i') AS date_format
                FROM cm_business_status AS bs 
                JOIN cm_matching AS m ON bs.m_id = m.id
                LEFT JOIN cm_partner AS p ON m.p_id = p.id
                LEFT JOIN cm_transfer AS t ON m.t_id = t.id
                WHERE p.id = '{$_GET['id']}'
                ORDER BY bs.id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td><?= $row['category'] ?></td>
          <td class="underbar"><a href="./partnerAdd.php"><?= $row['title'] ?></a></td>
          <td><?= $row['memo'] ?></td>
          <td><?= $row['t_name'] ?></td>
          <td><?= $row['m_name'] ?></td>
          <td><?= $row['date_format'] ?></td>
        </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/partnerList.php?id=<?= $_GET['id'] ?>&p=<?php
          if ($p <= 0) {
            echo $p;
          } else {
            echo $p - 10;
          }
          ?>'>
            <li class="page-left">&lt;</li>
          </a>
          <?php
          $id = $_GET['id'];
          $pages = ceil($pageTotal / $pageNum);
          $pageGroup = ceil($pages / 10);
          $pageCount = ceil(ceil($pages / $pageGroup) / 10) * 10;
          $pageEnd = ceil($pageTotal / 100) * 100 - 10;

          for ($j = 1; $j < $pageGroup + 1; $j++) {
            if ($p < 100) {
              $Count = 1;
            } elseif ($p <= $pageEnd - (100 * ($j - 1))) {
              $Count = 1 + (10 * $pageGroup) - (10 * $j);
            }
          }

          for ($i = $Count; $i - $Count < $pageCount; $i++) {
            $nextPage = $pageNum * ($i - 1);
            $activePage = $_GET['p'] / 10 + 1;
            $className = '';
            if ($activePage == $i) {
              $className = 'page-on';
            }
            echo "<a href='$_SERVER[PHP_SELF]?id=$id&p=$nextPage";

            echo "'><li class='$className'>$i</li></a>";

            if ($i >= $pages) {
              $i = $pages;
              break;
            }
          }
          ?>
          <a href='/admin/partnerList.php?id=<?= $_GET['id'] ?>&p=<?php
          if ($p + 10 >= $pageTotal) {
            echo $p;
          } else {
            echo $p + 10;
          }
          ?>'>
            <li class="page-right">&gt;</li>
          </a>
        </ul>
      </div>
      <!-- page -->
    </div>
    <!-- match_counsel -->

  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

<script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>