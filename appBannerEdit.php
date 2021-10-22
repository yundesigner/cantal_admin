<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM cm_notice WHERE id = '{$_GET['id']}'";
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

    <div class="match_form banner_submit">
      <h2 class="content_title">배너관리 등록하기</h2>
      <div class="match_title match_box">
        <ul>
          <li class="li_title">제목</li>
          <li class="li_content mr0"><input type="text" name="title"></li>
        </ul>
      </div>
      <div class="match_person">
        <div class="match_user">
          <ul class="match_user_writer match_box">
            <li class="li_title">이미지</li>
            <li class="li_content upload mr0"><label for="answer_img"><img
                  src="./images/icon_upload.png" alt="icon_upload"></label><input type="file" id="answer_img" class="dn">
            </li>
          </ul>
          <ul class="match_user_writer match_box">
            <li class="li_title">기간</li>
            <li class="li_content df mr0"><input type="date" value="2021-10-01" />
              <p>~</p><input type="date" value="2021-10-01" />
            </li>
          </ul>
        </div>
        <div class="match_partner match_box dn"></div>
      </div>
      <div class="match_content match_box">
        <p class="li_title mb15">내용</p><textarea class="match_content_inner fwb fs16"></textarea>
      </div>
      <div class="df_jsb"><a href="./appmanage.php">
          <button class="block black">목록보기</button>
        </a>
        <div class="btn_wrap"><a href="./appBanner.php" class="a-block">등록</a></div>
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