<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
  <div class="index_wrap appCommentPage">
    <?php $navApp='menu_focus'; include('_nav.php');?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php');?>
      <!-- header -->
      <ul class="tab">
        <li><a href="./appmanage.php">배너관리</a></li>
        <li><a href="./appNotice.php">공지관리</a></li>
        <li><a href="./appPush.php">푸쉬관리</a></li>
        <li><a href="./appComment.php" class="on">댓글관리</a></li> 
      </ul>

      <div class="table_wrap">
        <table class="match_table">
          <thead>
            <tr>
              <th>등록시간</th>
              <th>댓글작성자</th>
              <th>게시글제목</th>
              <th class="w50">댓글</th>
              <th>상세보기</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2021.08.12<br/>13:07:11</td>
              <td class="underbar">김댓글</td>
              <td class="underbar">게시글제목</td>
              <td>내용어쩌고저쩌고</td>
              <td class="detail">
                <button class="btn_detail counselMore">보기</button>
              </td>
            </tr>
            <tr>
              <td>2021.08.12<br/>13:07:11</td>
              <td class="underbar">김댓글</td>
              <td class="underbar">게시글제목</td>
              <td>내용어쩌고저쩌고</td>
              <td class="detail">
                <button class="btn_detail counselMore">보기</button>
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