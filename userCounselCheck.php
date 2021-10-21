<?php
require_once "../connect/db_connect.php";

$sql = "SELECT i.*, ui.*, date_format(date, '%Y-%m-%d') AS date_format
        FROM cm_inquiry AS i
        JOIN cm_user_info AS ui ON i.u_id = ui.u_id
        WHERE i.id = '{$_GET['id']}'";

$result = myQuery($sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
  <div class="index_wrap userCCPage">
    <?php $navUser = 'menu_focus';
  include('_nav.php'); ?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php'); ?>
      <!-- header -->
      <ul class="tab">
        <li><a href="./user.php">유저목록</a></li>
        <li><a href="./userCounsel.php" class="on">1:1 문의</a></li>
      </ul>

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

        <div class="match_person">
          <div class="match_user">
            <ul class="match_user_writer match_box">
              <li class="li_title">작성자</li>
              <li class="li_content"><?= $row['name'] ?></li>
              <li class="li_title">연락처</li>
              <li class="li_content"><?= $row['phone'] ?></li>
            </ul>
          </div>
          <div class="match_partner match_box dn">
          </div>
        </div>
        <!-- match_person -->

        <div class="match_content match_box">
          <p class="li_title">내용</p>
          <textarea class="match_content_inner fwb fs16" readonly><?= $row['content'] ?></textarea>
          <p class="li_title">사진</p>
          <?php
        if ($row['image']) {
          ?>
          <div class="match_photos">
            <div class="match_photo">
              <?php
              $dir = "../uploads/inquiry/" . $row['u_id'] . '/' . $row['image_path'];
              if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                  while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") { ?>
              <img src="<?= $dir . "/" . $file ?>">
              <?php
                    }
                  }
                  closedir($dh);
                }
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        </div>
        <!-- match_content -->
        <div class="answerBox">
          <div class="match_content match_box mt30">
            <p class="li_title">답변</p>
            <textarea class="match_content_inner fwb fs16" readonly>양도제품은 어떻게 배송이 진행되나요?</textarea>
            <p class="li_title">사진</p>
            <div class="match_photos">
              <div class="match_photo"></div>
            </div>
          </div>
          <div class="btn_wrap">
            <button class="block" onclick="answerRemove()">답변삭제</button>
            <button class="block" onclick="openModal('Answer')">답변수정</button>
          </div>
        </div>

        <div class="detail answerAddBtn">
          <button class="btn_detail" onclick="openModal('Answer')">답변등록</button>
        </div>


        <div class="modal_window modalAnswer">
          <div class="modal">
            <form action="" method="">
              <h3 class="modal_title">답변내용첨부</h3>
              <textarea class="modal_content w100"></textarea>
              <div class="df">
                <h3 class="modal_title">이미지첨부</h3>
                <label for="answer_img">
                  <img src="./images/icon_upload.png" alt="icon_upload">
                </label>
                <input type="file" id="answer_img" class="dn">
                <p class="upload_user"></p>
              </div>
              <div class="array">
                <button type="button" class="modal_close">취소</button>
                <button type="submit" class="modal_close" onclick="answerAdd();">답변등록</button>
              </div>
            </form>
          </div>
        </div>
        <!-- modalCounsel -->
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