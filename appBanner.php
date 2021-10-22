<?php
require_once "../connect/db_connect.php";

$sql = "SELECT n.*, ui.name, DATE_FORMAT(date, '%Y.%m.%d') AS date_format
        FROM cm_notice AS n
        JOIN cm_user_info AS ui ON n.ua_id = ui.u_id
        WHERE n.id = '{$_GET['id']}'";
$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$start_date = date_create($row['start_date']);
$end_date = date_create($row['end_date']);
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
      <h2 class="content_title">배너관리</h2>
      <div class="match_title match_box">
        <ul>
          <li class="li_title">제목</li>
          <li class="li_content">
            <p><?= $row['title'] ?></p>
          </li>
        </ul>
      </div>
      <!-- match_title -->

      <div class="match_person">
        <div class="match_user">
          <ul class="match_user_writer match_box">
            <li class="li_title">작성자</li>
            <li class="li_content"><?= $row['name'] ?></li>
          </ul>
          <ul class="match_user_writer match_box">
            <li class="li_title">작성일</li>
            <li class="li_content"><?= $row['date_format'] ?></li>
          </ul>
          <ul class="match_user_writer match_box">
            <li class="li_title">기간</li>
            <li class="li_content"><?= date_format($start_date, 'Y.m.d') ?>~<?= date_format($end_date, 'Y.m.d') ?></li>
          </ul>
        </div>
        <div class="match_partner match_box dn">
        </div>
      </div>
      <!-- match_person -->

      <div class="df">
        <div class="match_content match_box">
          <p class="li_title">이미지</p>
          <div class="img_area"><?php if ($row['image']) { ?>
              <img src="../uploads/notice/<?= $row['image_path'] . '/' . $row['image'] ?>" class="w400">
            <?php } ?></div>
        </div>
        <div class="match_content match_box">
          <p class="li_title">내용</p>
          <textarea class="match_content_inner fwb fs16" readonly><?= $row['content'] ?></textarea>
        </div>
        <!-- match_content -->
      </div>

      <div class="df_jsb">
        <a href="./appmanage.php">
          <button class="block black">목록보기</button>
        </a>

        <div class="btn_wrap">
          <a href="./appBanner_delete.php?id=<?= $_GET['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');"><button class="block orange">삭제</button></a>
          <a href="./appBannerEdit.php?id=<?= $_GET['id'] ?>" class="a-block">수정</a>
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