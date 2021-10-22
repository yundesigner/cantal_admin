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
      <?php
      if ($_GET['id']) {
      ?>
      <form action="appNoticeEdit_update.php?id=<?= $_GET['id'] ?>" method="post">
        <?php
        } else {
        ?>
        <form action="appNoticeEdit_create.php" method="post">
          <?php
          }
          ?>
          <h2 class="content_title">공지사항 <?php if ($_GET['id']) {
              echo '수정';
            } else {
              echo '등록';
            }
            ?>하기</h2>
          <div class="match_title match_box">
            <ul>
              <li class="li_title">제목</li>
              <li class="li_content mr0"><input type="text" name="title" value="<?= $row['title'] ?>" required /></li>
            </ul>
          </div>
          <div class="match_content match_box">
            <p class="li_title mb15">내용</p>
            <textarea class="match_content_inner fwb fs16" name="content" required /><?= $row['content'] ?></textarea>
          </div>
          <div class="df_jsb">
            <a href="./appNotice.php" class="block a-black">목록보기</a>
            <div class="btn_wrap">
              <button class="a-block"><?php if ($_GET['id']) {
                  echo '수정';
                } else {
                  echo '등록';
                }
                ?></button>
            </div>
          </div>
        </form>
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