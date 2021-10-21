<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
  <div class="index_wrap appPage">
    <?php $navApp='menu_focus'; include('_nav.php');?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php');?>
      <!-- header -->
      <ul class="tab">
        <li><a href="./appmanage.php" class="on">배너관리</a></li>
        <li><a href="./appNotice.php">공지관리</a></li>
        <li><a href="./appPush.php">푸쉬관리</a></li>
        <li><a href="./appComment.php">댓글관리</a></li>
      </ul>

      <div class="table_wrap">
        <button class="btn_counsel">등록</button>
        <table class="match_table">
          <thead>
            <tr>
              <th class="no">NO</th>
              <th>이벤트제목</th>
              <th>작성일</th>
              <th>기간</th>
              <th>상태</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td class="underbar"><a href="./appBanner.php">이벤트제목</a></td>
              <td>2021.08.21</td>
              <td>2021.08.21~2021.08.24</td>
              <td>진행</td>
            </tr>
            <tr>
              <td>2</td>
              <td class="underbar"><a href="./appBanner.php">이벤트제목</a></td>
              <td>2021.08.21</td>
              <td>2021.08.21~2021.08.24</td>
              <td>예정</td>
            </tr>
            <tr>
              <td>3</td>
              <td class="underbar"><a href="./appBanner.php">이벤트제목</a></td>
              <td>2021.08.21</td>
              <td>2021.08.21~2021.08.24</td>
              <td>종료</td>
            </tr>
          </tbody>
        </table>
        <div class="page">
          <ul>
            <li class="page-left">&lt;</li>
            <li class="page-on">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li class="page-right">&gt;</li>
          </ul>
        </div>
        <!-- page -->
      </div>

    </div>
    <!-- content_wrap -->
  </div>
  <!--index_wrap -->

  <script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>