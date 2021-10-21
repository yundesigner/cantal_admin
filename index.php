<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
  <div class="index_wrap indexPage">
    <?php $navIndex='menu_focus'; include('_nav.php');?>
    <!-- nav -->

    <div class="content_wrap">
      <?php include('_header.php');?>
      <!-- header -->
      <div class="form_wrap">
        <form action="" class="search">
          <input type="search" placeholder="고객이름, 제품명을 입력해주세요." class="txt_search" />
          <input type="submit" value="" class="btn_search" />
        </form>
        <form action="" class="radio">
          <p>진행현황</p>
          <input type="radio" id="all" name="sort" checked/>
          <label for="all">전체</label>
          <input type="radio" id="inquire" name="sort" />
          <label for="inquire">검토</label>
          <input type="radio" id="wait" name="sort" />
          <label for="wait">대기</label>
          <input type="radio" id="complete" name="sort" />
          <label for="complete">완료</label>
          <input type="radio" id="refund" name="sort" />
          <label for="refund">환불</label>
          <input type="radio" id="cancel" name="sort" />
          <label for="cancel">취소</label>
        </form>
      </div>
      <!-- form_wrap -->

      <div class="table_wrap">
        <table class="match_table">
          <thead>
            <tr>
              <th class="no">NO</th>
              <th>작성자</th>
              <th>신청자</th>
              <th>매칭날짜</th>
              <th>제품명</th>
              <th>파트너</th>
              <th>진행현황</th>
              <th class="detail">상세보기</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td class="underbar">홍길동</td>
              <td class="underbar">박철수</td>
              <td>2021.07.12</td>
              <td>LG 스타일러</td>
              <td>김영희</td>
              <td>매칭대기</td>
              <td class="detail">
                <a href="match.php">
                  <div class="btn_detail">보기</div>
                </a>
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

  <div class="login">
    <div class="login_in">
      <img src="./images/logo.png" alt="logo"></img>
      <form>
        <div class="login-form">
          <input type='text' placeholder='아이디' value='' name='loginId'></input>
        </div>
        <div class="login-form">
          <input type='password' placeholder='비밀번호' value='' name='loginPw'></input>
        </div>
        <div class="left">
          <input type="checkbox" name="checker" id="login" />
          <label for="login">자동 로그인</label>
        </div>
        <div class="blue-btn" onclick="login()">로그인하기</div>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>