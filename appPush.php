<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
  <div class="index_wrap appPushPage">
    <?php $navApp='menu_focus'; include('_nav.php');?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php');?>
      <!-- header -->
      <ul class="tab">
        <li><a href="./appmanage.php">배너관리</a></li>
        <li><a href="./appNotice.php">공지관리</a></li>
        <li><a href="./appPush.php" class="on">푸쉬관리</a></li>
        <li><a href="./appComment.php">댓글관리</a></li>
      </ul>

      <div class="table_wrap mt-17">
        <table class="match_table">
          <thead>
            <tr>
              <th class="no">NO</th>
              <th>제목</th>
              <th>등록일시</th>
              <th>작성자</th>
              <th>대상자</th>
              <th>자세히보기</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td class="underbar">공지사항입니다.</td>
              <td>2021.08.12</td>
              <td>홍길동</td>
              <td>전체</td>
              <td class="detail">
                <button class="btn_detail counselMore">보기</button>
              </td>
            </tr>
            <tr class="counsel_look">
              <td colspan="6">
                <textarea>공지사항에 대한 내용입니다.</textarea>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td class="underbar">매칭완료되었습니다.</td>
              <td>2021.08.12</td>
              <td>홍길동</td>
              <td>박렌탈</td>
              <td class="detail">
                <button class="btn_detail counselMore">보기</button>
              </td>
            </tr>
            <tr class="counsel_look">
              <td colspan="6">
                <textarea>공지사항에 대한 내용입니다.</textarea>
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