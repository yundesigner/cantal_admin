<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
  <div class="index_wrap matchPage">
    <?php $navIndex='menu_focus'; include('_nav.php');?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php');?>
      <!-- header -->
      <div class="btn-block">
        <h2 class="content_title">게시글 상세보기</h2>
        <button class="btn_counsel">작성글차단</button>
      </div>
      <div class="match_form">
        <div class="match_title match_box">
          <ul>
            <li class="li_title">제목</li>
            <li class="li_content">
              <p>제품양도하겠습니다</p>
              <p class="li_date">2021.08.21</p>
            </li>
          </ul>
        </div>
        <!-- match_title -->

        <div class="match_status match_box">
          <ul>
            <li class="li_title">작성자</li>
            <li class="li_content">홍길동</li>
            <li class="li_title">연락처</li>
            <li class="li_content">010-1234-5678</li>
            <li class="li_title">주소</li>
            <li class="li_content">부산광역시 서구 동대신동 1번지</li>
          </ul>
        </div>
        <!-- match_status -->

        <div class="match_content match_box">
          <p class="li_title">내용</p>
          <div class="match_content_inner">제품양도하겠습니다.</div>
          <p class="li_title">사진</p>
          <div class="match_photos">
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
            <div class="match_photo"></div>
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
              <tr>
                <td class="lh18">2021.08.21<br />13:07:11</td>
                <td class="underbar">김댓글</td>
                <td class="underbar comment_cnt">내용어쪼고</td>
                <td><button class="block">차단</button></td>
                <td>1건</td>
              </tr>

              <tr>
                <td class="lh18">2021.08.21<br />13:07:11</td>
                <td class="underbar">김댓글</td>
                <td class="underbar comment_cnt">내용어쪼고</td>
                <td><button class="block cancel">해제</button></td>
                <td>1건</td>
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