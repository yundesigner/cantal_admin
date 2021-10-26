<?php
require_once "../connect/db_connect.php";

$sql = "SELECT t.id, t.u_id, t.title, ui.name, ui.phone, ui.address, ui.address_detail, t.content, t.image_path, t.block,
        DATE_FORMAT(date, '%Y.%m.%d') AS date_format
        FROM cm_transfer AS t
        JOIN cm_user_info AS ui ON t.u_id = ui.u_id AND t.id = '{$_GET['id']}'";

$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$t_confirm_1 = "'게시글을 차단하시겠습니까?'";
$t_confirm_0 = "'차단을 해제하시겠습니까?'";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap matchPage">
  <?php $navIndex = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <div class="btn-block">
      <h2 class="content_title">게시글 상세보기</h2>
      <?php
      if ($row['block'] == 0) {
        echo '<button class="btn_counsel"><a href="transferBlock.php?id=' . $_GET['id'] . '&block=1" onclick="return confirm(' . $t_confirm_1 . ');" style="color: #FF4D00">작성글차단</a></button>';
      } else {
        echo '<button class="btn_counsel" style="border: 1px solid #565FA8;"><a href="transferBlock.php?id=' . $_GET['id'] . '&block=0" onclick="return confirm(' . $t_confirm_0 . ');" style="color: #565FA8">차단해제</a></button>';
      }
      ?>
    </div>
    <div class="match_form">
      <div class="match_title match_box">
        <ul>
          <li class="li_title">제목</li>
          <li class="li_content">
            <p><?= $row['title'] ?></p>
            <p class="li_date"><?= $row['date_format'] ?></p>
          </li>
        </ul>
      </div>
      <!-- match_title -->

      <div class="match_status match_box">
        <ul>
          <li class="li_title">작성자</li>
          <li class="li_content"><?= $row['name'] ?></li>
          <li class="li_title">연락처</li>
          <li class="li_content"><?= $row['phone'] ?></li>
          <li class="li_title">주소</li>
          <li class="li_content"><?= $row['address'] . ' ' . $row['address_detail'] ?></li>
        </ul>
      </div>
      <!-- match_status -->

      <div class="match_content match_box">
        <p class="li_title">내용</p>
        <div class="match_content_inner"><?= $row['content'] ?></div>
        <p class="li_title">사진</p>
        <div class="match_photos">
          <?php
          $dir = "../uploads/transfer/" . $row['u_id'] . '/' . $row['image_path'];
          if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
              while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") { ?>
                  <img class="match_photo wauto" src="<?= $dir . "/" . $file ?>">
                  <?php
                }
              }
              closedir($dh);
            }
          }
          ?>
        </div>
      </div>
      <!-- match_content -->

      <div class="match_comment">
        <h2 class="content_title">
          댓글 <span class="comment_counter"></span>
        </h2>
        <table class="match_table comment">
          <thead>
          <tr>
            <th>등록시간</th>
            <th>댓글작성자</th>
            <th>댓글</th>
            <th>차단</th>
            <th>신고현황</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $r_confirm_1 = "'댓글을 차단하시겠습니까?'";
          $r_confirm_0 = "'차단을 해제하시겠습니까?'";
          $pageNum = 2;
          $sql = "SELECT r.id, r.u_id, r.t_id, r.content, r.block, r.date, ui.name,
                  (SELECT COUNT(*) FROM cm_transfer_report WHERE r.id = r_id) AS count
                  FROM cm_reply AS r
                  JOIN cm_user_info AS ui ON r.u_id = ui.u_id
                  WHERE t_id = '{$_GET['id']}'
                  ORDER BY r.id DESC";
          $result = myQuery($sql);
          $pageTotal = mysqli_num_rows($result);
          $p = $_GET['p'];
          if (empty($p)) {
            $p = 0;
          } elseif ($p < 0) {
            $p = 0;
          } elseif ($p > $pageTotal) {
            $p = $p - 2;
          }
          $sql = "SELECT r.id, r.u_id, r.t_id, r.date, ui.name, r.content, r.block,
                  (SELECT COUNT(*) FROM cm_transfer_report WHERE r.id = r_id) AS count
                  FROM cm_reply AS r
                  JOIN cm_user_info AS ui ON r.u_id = ui.u_id
                  WHERE t_id = '{$_GET['id']}'
                  ORDER BY r.id DESC LIMIT {$p}, {$pageNum}";
          $result = myQuery($sql);

          while ($row = mysqli_fetch_array($result)) {
            $date = date_create($row['date']);
            ?>
            <tr>
              <td class="lh18"><?= date_format($date, "Y.m.d") ?><br /><?= date_format($date, "H:i:s") ?></td>
              <td class="underbar"><?= $row['name'] ?></td>
              <td class="underbar comment_cnt"><?= $row['content'] ?></td>
              <td><?php
                if ($row['block'] == 0) {
                  echo '<button class="block"><a href="replyBlock.php?id=' . $row['id'] . '&block=1" onclick="return confirm(' . $r_confirm_1 . ');" style="color: #fff">차단</a></button>';
                } else {
                  echo '<button class="block cancel"><a href="replyBlock.php?id=' . $row['id'] . '&block=0" onclick="return confirm(' . $r_confirm_0 . ');" style="color: #fff">해제</a></button>';
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
            <a href='/admin/transferDetail.php?id=<?= $_GET['id'] ?>&p=<?php
            if ($p <= 0) {
              echo $p;
            } else {
              echo $p - 2;
            }
            ?>'>
              <li class="page-left">&lt;</li>
            </a>
            <?php
            $id = $_GET['id'];
            $pages = ceil($pageTotal / $pageNum);
            $pageGroup = ceil($pages / 10);
            $pageCount = ceil(ceil($pages / $pageGroup) / 10) * 10;
            $pageEnd = ceil($pageTotal / 20) * 20 - 2;

            for ($j = 1; $j < $pageGroup + 1; $j++) {
              if ($p < 20) {
                $Count = 1;
              } elseif ($p <= $pageEnd - (20 * ($j - 1))) {
                $Count = 1 + (10 * $pageGroup) - (10 * $j);
              }
            }

            for ($i = $Count; $i - $Count < $pageCount; $i++) {
              $nextPage = $pageNum * ($i - 1);
              $activePage = $_GET['p'] / 2 + 1;
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
            <a href='/admin/transferDetail.php?id=<?= $_GET['id'] ?>&p=<?php
            if ($p + 2 >= $pageTotal) {
              echo $p;
            } else {
              echo $p + 2;
            }
            ?>'>
              <li class="page-right">&gt;</li>
            </a>
          </ul>
        </div>
        <!-- page -->
      </div>
      <!-- match_comment 댓글 -->

    </div>
    <!-- match_form -->
  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

<script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>