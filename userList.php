<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap">
  <?php $navUser = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./user.php" class="on">유저목록</a></li>
      <li><a href="./userCounsel.php">1:1 문의</a></li>
    </ul>

    <table class="user_info">
      <thead>
      <tr>
        <th>아이디</th>
        <th>가입일</th>
        <th>이름</th>
        <th>닉네임</th>
        <th>생년월일</th>
        <th>휴대폰번호</th>
        <th class="h64 pp">주소</th>
        <th>회원상태</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT *
              FROM cm_user AS u
              JOIN cm_user_info AS ui ON u.id = ui.u_id
              WHERE ui.u_id = '{$_GET['id']}'";
      $result = myQuery($sql);
      $row = mysqli_fetch_array($result);
      ?>
      <tr>
        <td><?= $row['email'] ?></td>
        <td><?= $row['join_date'] ?></td>
        <form action="userList_modify.php?id=<?= $_GET['id'] ?>" method="post" id="member_state">
          <td><input type="text" name="name" value="<?= $row['name'] ?>" /></td>
          <td><input type="text" name="nickname" value="<?= $row['nickname'] ?>" /></td>
          <td><input type="date" name="birthday" value="<?= $row['birthday'] ?>" /></td>
          <td><input type="text" name="phone" value="<?= $row['phone'] ?>" /></td>
          <td class="h64">
            <input type="text" name="address" value="<?= $row['address'] ?>" />
            <input type="text" name="address_detail" value="<?= $row['address_detail'] ?>" />
          </td>
          <td class="member_state">
            <select name="status" id="match_select">
              <option value="정회원" <?php if ($row['status'] === "정회원") {
                echo "selected";
              } ?>>정회원
              </option>
              <option value="정지회원" <?php if ($row['status'] === "정지회원") {
                echo "selected";
              } ?>>정지회원
              </option>
              <option value="탈퇴회원" <?php if ($row['status'] === "탈퇴회원") {
                echo "selected";
              } ?>>탈퇴회원
              </option>
            </select>
            <button type="submit" class="member_state_submit blue"
                    onclick="return confirm('정보를 수정하시겠습니까?')">수정
            </button>
        </form>
        </td>
      </tr>
      </tbody>
    </table>

    <div class="user_active">
      <h2 class="content_title">활동현황</h2>
      <table>
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>등록일시</th>
          <th>작성자</th>
          <th>댓글</th>
          <th>상세보기</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $a_pageNum = 5;
        $sql = "SELECT '게시글작성' AS category, t.id, t.title, t.date, ui.name,
                (SELECT COUNT(*) FROM cm_reply WHERE t_id = t.id) AS count
                FROM cm_transfer AS t
                JOIN cm_user_info AS ui ON t.u_id = ui.u_id AND ui.u_id = '{$_GET['id']}'
                UNION ALL
                SELECT '댓글' AS category, t.id, t.title, r.date, (SELECT name FROM cm_user_info WHERE u_id =  t.u_id) AS name,
                (SELECT COUNT(*) FROM cm_reply WHERE t_id = t.id) AS count
                FROM cm_reply AS r
                JOIN cm_transfer AS t ON r.t_id = t.id
                JOIN cm_user_info AS ui ON r.u_id = ui.u_id AND ui.u_id = '{$_GET['id']}'
                ORDER BY date DESC";
        $result = myQuery($sql);
        $a_pageTotal = mysqli_num_rows($result);
        $a_p = $_GET['a_p'];
        if (empty($a_p)) {
          $a_p = 0;
        } elseif ($a_p < 0) {
          $a_p = 0;
        } elseif ($a_p > $a_pageTotal) {
          $a_p = $a_p - 5;
        }
        $sql = "SELECT '게시글작성' AS category, t.id, t.title, t.date, ui.name,
                (SELECT COUNT(*) FROM cm_reply WHERE t_id = t.id) AS count
                FROM cm_transfer AS t
                JOIN cm_user_info AS ui ON t.u_id = ui.u_id AND ui.u_id = '{$_GET['id']}'
                UNION ALL
                SELECT '댓글' AS category, t.id, t.title, r.date, (SELECT name FROM cm_user_info WHERE u_id =  t.u_id) AS name,
                (SELECT COUNT(*) FROM cm_reply WHERE t_id = t.id) AS count
                FROM cm_reply AS r
                JOIN cm_transfer AS t ON r.t_id = t.id
                JOIN cm_user_info AS ui ON r.u_id = ui.u_id AND ui.u_id = '{$_GET['id']}'
                ORDER BY date DESC LIMIT {$a_p}, {$a_pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
          $date = date_create($row['date']);
          ?>
          <tr>
            <td><?= $row['category'] ?></td>
            <td class="underbar"><a href="./transferDetail.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
            <td><?= date_format($date, 'Y.m.d') ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['count'] ?></td>
            <td class="detail">
              <a href="./transferDetail.php?id=<?= $row['id'] ?>" class="btn_detail">보기</a>
            </td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
      <?php
      if ($date) {
        ?>
        <div class="page">
          <ul>
            <a href='/admin/userList.php?id=<?= $_GET['id'] ?>&a_p=<?php
            if ($a_p <= 0) {
              echo $a_p;
            } else {
              echo $a_p - 5;
            }
            ?>'>
              <li class="page-left">&lt;</li>
            </a>
            <?php
            $id = $_GET['id'];
            $a_pages = ceil($a_pageTotal / $a_pageNum);
            $a_pageGroup = ceil($a_pages / 10);
            $a_pageCount = ceil(ceil($a_pages / $a_pageGroup) / 10) * 10;
            $a_pageEnd = ceil($a_pageTotal / 50) * 50 - 5;

            for ($j = 1; $j < $a_pageGroup + 1; $j++) {
              if ($a_p < 50) {
                $a_Count = 1;
              } elseif ($a_p <= $a_pageEnd - (50 * ($j - 1))) {
                $a_Count = 1 + (10 * $a_pageGroup) - (10 * $j);
              }
            }

            for ($i = $a_Count; $i - $a_Count < $a_pageCount; $i++) {
              $a_nextPage = $a_pageNum * ($i - 1);
              $a_activePage = $_GET['a_p'] / 5 + 1;
              $className = '';
              if ($a_activePage == $i) {
                $className = 'page-on';
              }
              echo "<a href='$_SERVER[PHP_SELF]?id=$id&a_p=$a_nextPage";

              echo "'><li class='$className'>$i</li></a>";

              if ($i >= $a_pages) {
                $i = $a_pages;
                break;
              }
            }
            ?>
            <a href='/admin/userList.php?id=<?= $_GET['id'] ?>&a_p=<?php
            if ($a_p + 5 >= $a_pageTotal) {
              echo $a_p;
            } else {
              echo $a_p + 5;
            }
            ?>'>
              <li class="page-right">&gt;</li>
            </a>
          </ul>
        </div>
        <?php
      }
      ?>
      <!-- page -->
    </div>
    <!-- match_counsel -->

    <div class="modal_window modalCounsel">
      <div class="modal">
        <h3 class="modal_title">상담내용작성</h3>
        <textarea class="modal_content"></textarea>
        <div class="array">
          <button class="modal_close">취소</button>
          <button class="modal_close">상담등록</button>
        </div>
      </div>
    </div>
    <!-- modalCounsel -->

    <div class="user_push">
      <h2 class="content_title">푸쉬현황</h2>
      <button class="btn_counsel" onclick="openModal('Push')">개인푸시</button>
      <table class="match_table">
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>등록일시</th>
          <th>관리자</th>
          <th>상세보기</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $p_pageNum = 2;
        $sql = "SELECT ap.*, (SELECT name FROM cm_user_info WHERE u_id = ap.ua_id) AS a_name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
                FROM cm_app_push AS ap
                LEFT JOIN cm_user_info AS ui ON ap.u_id = ui.u_id
                WHERE ui.u_id = '{$_GET['id']}' OR ap.target = '전체'
                ORDER BY ap.id DESC";
        $result = myQuery($sql);
        $p_pageTotal = mysqli_num_rows($result);
        $p_p = $_GET['p_p'];
        if (empty($p_p)) {
          $p_p = 0;
        } elseif ($p_p < 0) {
          $p_p = 0;
        } elseif ($p_p > $p_pageTotal) {
          $p_p = $p_p - 2;
        }
        $sql = "SELECT ap.*, (SELECT name FROM cm_user_info WHERE u_id = ap.ua_id) AS a_name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
                FROM cm_app_push AS ap
                LEFT JOIN cm_user_info AS ui ON ap.u_id = ui.u_id
                WHERE ui.u_id = '{$_GET['id']}' OR ap.target = '전체'
                ORDER BY ap.id DESC LIMIT {$p_p}, {$p_pageNum}";
        $result = myQuery($sql);

        while ($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?= $row['target'] ?>푸시</td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['date_format'] ?></td>
            <td class=""><?= $row['a_name'] ?></td>
            <td class="detail">
              <button class="btn_detail" onclick="openModal('<?= $row['id'] ?>')">보기</button>
            </td>
          </tr>

          <div class="modal_window modal<?= $row['id'] ?> pf">
            <div class="modal">
              <h3 class="modal_title">푸시제목</h3>
              <input type="text" class="modalPush_titleArea" value="<?= $row['title'] ?>" readonly>
              <h3 class="modal_title">푸시내용</h3>
              <textarea class="modal_content" readonly><?= $row['content'] ?></textarea>
              <button class="modal_close">닫기</button>
            </div>
          </div>
          <?php
        }
        ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/userList.php?id=<?= $_GET['id'] ?>&p_p=<?php
          if ($p_p <= 0) {
            echo $p_p;
          } else {
            echo $p_p - 2;
          }
          ?>'>
            <li class="page-left">&lt;</li>
          </a>
          <?php
          $id = $_GET['id'];
          $p_pages = ceil($p_pageTotal / $p_pageNum);
          $p_pageGroup = ceil($p_pages / 10);
          $p_pageCount = ceil(ceil($p_pages / $p_pageGroup) / 10) * 10;
          $p_pageEnd = ceil($p_pageTotal / 20) * 20 - 2;

          for ($j = 1; $j < $p_pageGroup + 1; $j++) {
            if ($p_p < 20) {
              $p_Count = 1;
            } elseif ($p_p <= $p_pageEnd - (20 * ($j - 1))) {
              $p_Count = 1 + (10 * $p_pageGroup) - (10 * $j);
            }
          }

          for ($i = $p_Count; $i - $p_Count < $p_pageCount; $i++) {
            $p_nextPage = $p_pageNum * ($i - 1);
            $p_activePage = $_GET['p_p'] / 2 + 1;
            $className = '';
            if ($p_activePage == $i) {
              $className = 'page-on';
            }
            echo "<a href='$_SERVER[PHP_SELF]?id=$id&p_p=$p_nextPage";

            echo "'><li class='$className'>$i</li></a>";

            if ($i >= $p_pages) {
              $i = $p_pages;
              break;
            }
          }
          ?>
          <a href='/admin/userList.php?id=<?= $_GET['id'] ?>&p_p=<?php
          if ($p_p + 2 >= $p_pageTotal) {
            echo $p_p;
          } else {
            echo $p_p + 2;
          }
          ?>'>
            <li class="page-right">&gt;</li>
          </a>
        </ul>
      </div>
      <!-- page -->
    </div>
    <!-- user_push -->
    <div class="modal_window modalPush">
      <div class="modal">
        <form>
          <h3 class="modal_title">푸시제목</h3>
          <input type="text" class="modalPush_titleArea">
          <h3 class="modal_title">푸시내용</h3>
          <textarea class="modal_content"></textarea>
          <div class="array">
            <button type="button" class="modal_close">취소</button>
            <button class="modal_close">푸시등록</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

<script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>