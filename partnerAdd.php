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
      <li><a href="./partner.php">파트너목록</a></li>
      <li><a href="./partnerAdd.php" class="on">파트너등록</a></li>
    </ul>
    <?php
    if ($_GET['id']) {
    ?>
    <form action="partnerAdd_update.php?id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
      <?php
      } else {
      ?>
      <form action="partnerAdd_create.php" method="post" enctype="multipart/form-data">
        <?php
        }
        ?>
        <div class="df">
          <table class="user_info">
            <thead>
            <tr>
              <th>이름<span>*</span></th>
              <th>생년월일<span>*</span></th>
              <th>휴대폰번호<span>*</span></th>
              <th>업체이름</th>
              <th>이메일</th>
              <th>업체대표번호</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($_GET['id']) {
              $sql = "SELECT * FROM cm_partner WHERE id = '{$_GET['id']}'";
              $result = myQuery($sql);
              $row = mysqli_fetch_array($result);
              ?>
              <tr>
                <td><input type="text" name="name" value="<?= $row['name'] ?>" required /></td>
                <td><input type="date" name="birthday" value="<?= $row['birthday'] ?>" required /></td>
                <td><input type="text" name="phone" value="<?= $row['phone'] ?>" required /></td>
                <td><input type="text" name="company_name" value="<?= $row['company_name'] ?>" /></td>
                <td><input type="email" name="email" value="<?= $row['email'] ?>" /></td>
                <td><input type="text" name="company_phone" value="<?= $row['company_phone'] ?>" /></td>
              </tr>
              <?php
            } else {
              ?>
              <tr>
                <td><input type="text" name="name" placeholder="홍길동" required /></td>
                <td><input type="date" name="birthday" placeholder="1993-03-21" required /></td>
                <td><input type="text" name="phone" placeholder="010-1234-5678" required /></td>
                <td><input type="text" name="company_name" placeholder="웅진코웨이" /></td>
                <td><input type="email" name="email" placeholder="123@email.com" /></td>
                <td><input type="text" name="company_phone" placeholder="1644-1000" /></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>

          <table class="user_info partner_picture">
            <thead>
            <tr>
              <th>사진<span>*</span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td class="upload">
                <label for="upload">
                  <img src="./images/icon_upload.png" alt="icon_upload">
                </label>
                <input type="file" id="upload" class="dn" name="upload">
                <p class="upload_name"></p>
              </td>
            </tr>
            </tbody>
          </table>
        </div>

        <div class="array">
          <button class="modal_close">등록</button>
        </div>
      </form>

  </div>
  <!-- content_wrap -->
</div>
<!--index_wrap -->

</div>

<script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
<script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>