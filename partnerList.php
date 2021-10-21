<?php
require_once "../connect/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap partnerAddPage">
  <?php $navPartner = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <ul class="tab">
      <li><a href="./partner.php" class="on">파트너목록</a></li>
      <li><a href="./partnerAdd.php">파트너등록</a></li>
    </ul>
    <div class="df">
      <table class="user_info">
        <thead>
        <tr>
          <th>이름</th>
          <th>생년월일</th>
          <th>휴대폰번호</th>
          <th>업체이름</th>
          <th>이메일</th>
          <th>업체대표번호</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM cm_partner WHERE id = '{$_GET['id']}'";
        $result = myQuery($sql);
        $row = mysqli_fetch_array($result);
        ?>
        <tr>
          <td><?= $row['name'] ?></td>
          <td><?= $row['birthday'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><?= $row['company_name'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['company_phone'] ?></td>
        </tr>
        </tbody>
      </table>

      <table class="user_info partner_picture">
        <thead>
        <tr>
          <th>사진</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ml-26"><img src="../uploads/partner/<?= $row['image_path'] . '/' . $row['image'] ?>"></td>
        </tr>
        </tbody>
      </table>
    </div>

    <div class="array">
      <button class="modal_close del"><a href="partnerAdd_delete.php?id=<?= $_GET['id'] ?>">삭제</a></button>
      <button class="modal_close"><a href="partnerAdd.php?id=<?= $_GET['id'] ?>">수정</a></button>
    </div>

    <div class="user_active">
      <h2 class="content_title">업무현황</h2>
      <table>
        <thead>
        <tr>
          <th>구분</th>
          <th>제목</th>
          <th>메모</th>
          <th>제품명</th>
          <th>작성자</th>
          <th>양도자</th>
          <th>업무시간</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>연락</td>
          <td class="underbar"><a href="./partnerAdd.php">제품양도합니다</a></td>
          <td></td>
          <td>LG스타일러</td>
          <td>홍길동</td>
          <td>박철수</td>
          <td>2021.08.12 13:01</td>
        </tr>

        <tr>
          <td>배송완료</td>
          <td class="underbar"><a href="./partnerAdd.php">제품양도합니다</a></td>
          <td></td>
          <td>LG스타일러</td>
          <td>홍길동</td>
          <td>박철수</td>
          <td>2021.08.12 13:01</td>
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

  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

<script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>