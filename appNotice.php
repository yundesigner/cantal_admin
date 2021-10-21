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
        <li><a href="./appmanage.php">배너관리</a></li>
        <li><a href="./appNotice.php" class="on">공지관리</a></li>
        <li><a href="./appPush.php">푸쉬관리</a></li>
        <li><a href="./appComment.php">댓글관리</a></li>
      </ul>

      <div class="table_wrap w70">
        <button class="btn_counsel">등록</button>
        <table class="match_table">
          <thead>
            <tr>
              <th class="no">NO</th>
              <th>제목</th>
              <th class="w126">등록일시</th>
              <th class="w126">작성자</th>
              <th class="w126">자세히보기</th> 
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td class="underbar"><a href="./appNoticeAdd.php">공지사항입니다.</a></td>
              <td>2021.08.21</td>
              <td>홍길동</td>
              <td class="detail">
                <a href="./appNoticeAdd.php" class="btn_detail">보기</a>
              </td>
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

  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
</body>

</html>