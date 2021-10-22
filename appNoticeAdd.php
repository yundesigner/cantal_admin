<?php
require_once "../connect/db_connect.php";

$sql = "SELECT n.*, ui.name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
        FROM cm_notice AS n
        JOIN cm_user_info AS ui ON n.ua_id = ui.u_id
        WHERE n.id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap appBannerPage">
  <?php $navApp = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap banner_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->

    <div class="match_form banner_in">
      <h2 class="content_title">공지사항</h2>
      <div class="match_title match_box">
        <ul>
          <li class="li_title">제목</li>
          <li class="li_content mr0">
            <p><?= $row['title'] ?></p>
          </li>
        </ul>
      </div>
      <!-- match_title -->

      <div class="match_person">
        <div class="match_user">
          <ul class="match_user_writer match_box">
            <li class="li_title">작성자</li>
            <li class="li_content mr0"><?= $row['name'] ?></li>
          </ul>
          <ul class="match_user_writer match_box">
            <li class="li_title">작성일</li>
            <li class="li_content mr0"><?= $row['date_format'] ?></li>
          </ul>
        </div>
        <div class="match_partner match_box dn">
        </div>
      </div>
      <!-- match_person -->

      <div class="match_content match_box">
        <p class="li_title mb15">내용</p>
        <textarea class="match_content_inner fwb fs16" readonly><?= $row['content'] ?></textarea>
      </div>

      <div class="df_jsb">
        <a href="./appNotice.php">
          <button class="block black">목록보기</button>
        </a>

        <div class="btn_wrap">
          <a href="./appNoticeAdd_delete.php?id=<?= $_GET['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');"><button class="block orange">삭제</button></a>
          <a href="./appNoticeEdit.php?id=<?= $_GET['id'] ?>" class="a-block">수정</a>
        </div>
      </div>
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