<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="eventpage_wrap">
  <?php $navEvent = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->

    <?php $search = $_GET['search']; ?>

    <div class="form_wrap">
      <form action="eventpage.php" method="get" class="search">
        <input type="search" placeholder="이벤트 제목, 신청자 등을 입력해주세요." class="txt_search" name="search"
               value="<?= $search ?>" />
        <input type="submit" value="" class="btn_search" />
      </form>
    </div>
    <!-- form_wrap -->

    <div class="table_wrap">
      <table>
        <thead>
        <tr>
          <th class="no">NO</th>
          <th class="eventtable_content">문의내용</th>
          <th>문의자</th>
          <th>연락처</th>
          <th>문의일시</th>
          <th class="detail">상담여부</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $confirm = "'상담을 완료하시겠습니까?'";
        $pageNum = 15;
        $sql = "SELECT *, date_format(date, '%Y-%m-%d') AS date_format
                FROM cm_event
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
        $sql = "SELECT *, date_format(date, '%Y-%m-%d') AS date_format
                FROM cm_event
                ORDER BY id DESC LIMIT {$p}, {$pageNum}";
        $result = myQuery($sql);

        if ($search) {
          $pageNum = 15;
          $sql = "SELECT *, date_format(date, '%Y-%m-%d') AS date_format
                  FROM cm_event
                  WHERE content LIKE '%{$search}%' OR name LIKE '%{$search}%' OR phone LIKE '%{$search}%'
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
          $sql = "SELECT *, date_format(date, '%Y-%m-%d') AS date_format
                  FROM cm_event
                  WHERE content LIKE '%{$search}%' OR name LIKE '%{$search}%' OR phone LIKE '%{$search}%'
                  ORDER BY id DESC LIMIT {$p}, {$pageNum}";
          $result = myQuery($sql);
        }

        while ($row = mysqli_fetch_array($result)) {
          $content = $row['content'];
          if (mb_strlen($content) > 30) {
            $content = str_replace($content, mb_substr($content, 0, 30, "utf-8") . "...", $content);
          }
          ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td class="underbar" onclick="openModal(<?= $row['id'] ?>)"><?= $content ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['date_format'] ?></td>
            <td>
              <?php
              if ($row['status'] == '대기') {
                echo '<div class="btn_detail btn-modal event_btn" xmlns="https://www.w3.org/1999/html">
                        <a href="eventpage_status.php?id=' . $row['id'] . '" onclick="return confirm(' . $confirm . ');">대기</a>
                      </div>';
              } elseif ($row['status'] == '완료') {
                echo '<div class="btn_detail event_btn complete">완료</div>';
              }
              ?>
            </td>
          </tr>

          <div class="modal_window modal<?= $row['id'] ?>">
            <div class="modal">
              <h3 class="modal_title">문의내용</h3>
              <div class="modal_content"><?= $row['content'] ?></div>
              <button class="modal_close">확인</button>
            </div>
          </div>
        <?php } ?>
        </tbody>
      </table>
      <div class="page">
        <ul>
          <a href='/admin/eventpage.php?p=<?php
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
          <a href='/admin/eventpage.php?p=<?php
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
<!--eventpage_wrap -->

<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
<script src="https://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
</body>

</html>