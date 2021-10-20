<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap">
  <?php $navUser = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./user.php" class="on">유저목록</a></li>
      <li><a href="./userCounsel.php">1:1 문의</a></li>
    </ul>

    <table class="user_info">
      <thead>
      <tr>
        <th>아이디</th>
        <th>가입일</th>
        <th>이름</th>
        <th>닉네임</th>
        <th>생년월일</th>
        <th>휴대폰번호</th>
        <th class="h64 pp">주소</th>
        <th>회원상태</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT *
              FROM cm_user AS u
              JOIN cm_user_info AS ui ON u.id = ui.u_id
              WHERE ui.id = '{$_GET['id']}'";
      $result = myQuery($sql);
      $row = mysqli_fetch_array($result);
      ?>
      <tr>
        <td><?= $row['email'] ?></td>
        <td><?= $row['join_date'] ?></td>
        <form action="userList_modify.php?id=<?= $_GET['id'] ?>" method="post" id="member_state">
          <td><input type="text" name="name" value="<?= $row['name'] ?>" /></td>
          <td><input type="text" name="nickname" value="<?= $row['nickname'] ?>" /></td>
          <td><input type="date" name="birthday" value="<?= $row['birthday'] ?>" /></td>
          <td><input type="text" name="phone" value="<?= $row['phone'] ?>" /></td>
          <td class="h64">
            <input type="text" name="address" value="<?= $row['address'] ?>" />
            <input type="text" name="address_detail" value="<?= $row['address_detail'] ?>" />
          </td>
          <td class="member_state">
            <select name="status" id="match_select">
              <option value="정회원" <?php if ($row['status'] === "정회원") {
                echo "selected";
              } ?>>정회원</option>
              <option value="정지회원" <?php if ($row['status'] === "정지회원") {
                echo "selected";
              } ?>>정지회원</option>
              <option value="탈퇴회원" <?php if ($row['status'] === "탈퇴회원") {
                echo "selected";
              } ?>>탈퇴회원</option>
            </select>
            <button type="submit" class="member_state_submit blue" onclick="return confirm('정보를 수정하시겠습니까?')">수정</button>
        </form>
        </td>
      </tr>
      </tbody>
    </table>

    <div class="user_active">
      <h2 class="content_title">활동현황</h2>
      <table>
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>등록일시</th>
          <th>작성자</th>
          <th>댓글</th>
          <th>상세보기</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>게시글작성</td>
          <td class="underbar">제품양도합니다</td>
          <td>2021.08.12</td>
          <td>홍길동</td>
          <td>2</td>
          <td class="detail">
            <button class="btn_detail goToMatch">보기</button>
            <!-- ★★ : 보기 누르면 매칭관리 창으로 이동, 소스 = app.js 안에 있음 -->
          </td>
        </tr>

        <tr>
          <td>댓글</td>
          <td class="underbar">제품양도합니다</td>
          <td>2021.08.12</td>
          <td>박철수</td>
          <td>4</td>
          <td class="detail">
            <button class="btn_detail goToMatch">보기</button>
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
    <!-- match_counsel -->

    <div class="modal_window modalCounsel">
      <div class="modal">
        <h3 class="modal_title">상담내용작성</h3>
        <textarea class="modal_content"></textarea>
        <div class="array">
          <button class="modal_close">취소</button>
          <button class="modal_close">상담등록</button>
        </div>
      </div>
    </div>
    <!-- modalCounsel -->

    <div class="user_push">
      <h2 class="content_title">푸쉬현황</h2>
      <button class="btn_counsel" onclick="openModal('Push')">개인푸시</button>
      <table class="match_table">
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>등록일시</th>
          <th>관리자</th>
          <th>상세보기</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>전체푸시</td>
          <td class="underbar">공지사항입니다.</td>
          <td>2021.08.12</td>
          <td class="">관리자</td>
          <td class="detail">
            <button class="btn_detail" onclick="openModal('PushRO')">보기</button>
          </td>
        </tr>

        <tr>
          <td>개인푸시</td>
          <td class="underbar">매칭등록이 완료되었습니다.</td>
          <td>2021.08.12</td>
          <td class="">관리자</td>
          <td class="detail">
            <button class="btn_detail" onclick="openModal('PushRO')">보기</button>
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
    <!-- user_push -->
    <div class="modal_window modalPush">
      <div class="modal">
        <h3 class="modal_title">푸시제목</h3>
        <input type="text" class="modalPush_titleArea"></input>
        <h3 class="modal_title">푸시내용</h3>
        <textarea class="modal_content"></textarea>
        <div class="array">
          <button class="modal_close">취소</button>
          <button class="modal_close">푸시등록</button>
        </div>
      </div>
    </div>
    <!-- modalPush -->
    <div class="modal_window modalPushRO">
      <div class="modal">
        <h3 class="modal_title">푸시제목</h3>
        <input type="text" class="modalPush_titleArea" readonly></input>
        <h3 class="modal_title">푸시내용</h3>
        <textarea class="modal_content" readonly></textarea>
        <button class="modal_close">닫기</button>
      </div>
    </div>
    <!-- modalPush -->

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

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>

</html>