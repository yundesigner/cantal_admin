<?php
require_once "../connect/db_connect.php";

$sql = "SELECT * FROM
        (SELECT m.id, t.u_id, t.title, ui.name, ui.phone, ui.address, ui.address_detail, m.status, t.content, t.image_path, m.cancel_comment,
        m.phone AS d_phone, m.address AS d_address, m.address_detail AS d_address_detail, m.delivery_comment, m.delivery_min_date, m.delivery_max_date,
        DATE_FORMAT(m.date, '%Y.%m.%d') AS date_format
        FROM cm_transfer AS t
        JOIN cm_matching AS m ON t.id = m.t_id AND m.id = '{$_GET['id']}'
        JOIN cm_user_info AS ui ON t.u_id = ui.u_id) AS a

        JOIN

        (SELECT m.id, m.u_id AS m_u_id,ui.name AS m_name, ui.phone AS m_phone, ui.address AS m_address, ui.address_detail AS m_address_detail
        FROM cm_matching AS m
        JOIN cm_user_info AS ui ON m.u_id = ui.u_id AND m.id = '{$_GET['id']}') AS b ON a.id = b.id

        LEFT JOIN

        (SELECT m.id, p.name AS p_name, p.phone AS p_phone, p.company_name AS p_company_name
        FROM cm_matching AS m
        JOIN cm_partner AS p ON m.p_id = p.id AND m.id = '{$_GET['id']}') AS c ON a.id = c.id";

$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$u_id = $row['u_id'];
$name = $row['name'];
$m_u_id = $row['m_u_id'];
$m_name = $row['m_name'];
$d_phone = $row['d_phone'];
$d_address = $row['d_address'];
$d_address_detail = $row['d_address_detail'];
$delivery_min_date = $row['delivery_min_date'];
$delivery_max_date = $row['delivery_max_date'];
$delivery_comment = $row['delivery_comment'];
$status = $row['status'];
$cancel_comment = $row['cancel_comment'];
$content = $row['content'];
$image_path = $row['image_path'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php'); ?>
<!-- head -->

<body>
<div class="index_wrap matchPage">
  <?php $navIndex = 'menu_focus';
  include('_nav.php'); ?>
  <!-- nav -->

  <div class="content_wrap">
    <?php include('_header.php'); ?>
    <!-- header -->
    <div class="btn-block">
      <h2 class="content_title">매칭 상세보기</h2>
    </div>
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

      <script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
      <script>
        function openModal(num) {
          $(".modal" + num).css("display", "flex");
          $(".modal_close").click(function () {
            $(".modal" + num).css("display", "none");
          });
        }
      </script>
      <div class="match_person">
        <div class="match_user">
          <ul class="match_user_writer match_box">
            <li class="li_title">작성자</li>
            <li class="li_content"><?= $row['name'] ?></li>
            <li class="li_title">연락처</li>
            <li class="li_content"><?= $row['phone'] ?></li>
            <li class="li_title">주소</li>
            <li class="li_content"><?= $row['address'] . ' ' . $row['address_detail'] ?></li>
          </ul>
          <ul class="match_user_volunteer match_box">
            <li class="li_title">신청자</li>
            <li class="li_content"><?= $row['m_name'] ?></li>
            <li class="li_title">연락처</li>
            <li class="li_content"><?= $row['m_phone'] ?></li>
            <li class="li_title">주소</li>
            <li class="li_content"><?= $row['m_address'] . ' ' . $row['m_address_detail'] ?></li>
          </ul>
        </div>
        <div class="match_partner match_box">
          <?php
          if ($row['p_name']) {
            ?>
            <div class="partner_info">
              <ul>
                <li class="li_title">파트너</li>
                <li class="li_content"><?= $row['p_name'] ?></li>
                <li class="li_title">연락처</li>
                <li class="li_content"><?= $row['p_phone'] ?></li>
              </ul>
              <ul>
                <li class="li_title">업체</li>
                <li class="li_content"><?= $row['p_company_name'] ?></li>
                <button type="submit" class="match_status_submit gray" onclick="openModal('Partner')">수정</button>
              </ul>
            </div>
            <?php
          } else {
            ?>
            <img src="./images/patch_partner.png" class="remove_prev" onclick="openModal('Partner')">
            <?php
          }
          ?>
        </div>
      </div>
      <!-- match_person -->

      <script type="text/javascript">
        function update_cate1() {
          var company = $('#company option:selected').val();
          $.get('get_cate.php?type=1&company=' + company, show_cates1);
        }

        function show_cates1(res) {
          $('#p_name').html(res);
          $('#p_phone').html("");
        }

        function update_cate2() {
          var company = $('#company option:selected').val();
          var p_name = $('#p_name option:selected').val();
          $.get('get_cate.php?type=2&company=' + company + '&p_name=' + p_name, show_cates2);
        }

        function show_cates2(res2) {
          $('#p_phone').html(res2);
        }
      </script>

      <div class="modal_window modalPartner">
        <div class="modal w314">
          <form action="match_partner.php?id=<?= $_GET['id'] ?>" method="post">
            <div class="modal_in">
              <h3 class="modal_title fw800">파트너등록</h3>
              <div class="modal_section">
                <h3 class="modal_title">업체이름</h3>
                <select id="company" name="company" class="select_basic" onchange="update_cate1();">
                  <option value="">업체선택</option>
                  <?php
                  $sql = "SELECT company_name FROM cm_partner GROUP BY company_name ORDER BY company_name ASC";
                  $result = myQuery($sql);

                  while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?= $row['company_name'] ?>"><?= $row['company_name'] ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="modal_section">
                <h3 class="modal_title">이름</h3>
                <select id="p_name" name="p_name" class="select_basic" onchange="update_cate2();">
                  <option value=""></option>
                </select>
              </div>
              <div class="modal_section">
                <h3 class="modal_title">연락처</h3>
                <select id="p_phone" name="p_phone" class="select_basic">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="array">
              <button type="button" class="modal_close">취소</button>
              <button type="submit" class="modal_close partner_add" onclick="partnerAdd();">등록</button>
            </div>
          </form>
        </div>
      </div>
      <!-- modalWork -->

      <div class="match_status match_box">
        <ul>
          <li class="li_title">수령자</li>
          <li class="li_content"><?= $m_name ?></li>
          <li class="li_title">연락처</li>
          <li class="li_content"><?= $d_phone ?></li>
          <li class="li_title">주소</li>
          <li class="li_content"><?= $d_address . ' ' . $d_address_detail ?></li>
          <li class="li_title">배송가능일</li>
          <li class="li_content"><?= $delivery_min_date . ' ~ ' . $delivery_max_date ?></li>
        </ul>
        <button class="mb-3 match_status_submit gray wauto" onclick="openModal('Shipping')">요청사항</button>
      </div>
      <div class="modal_window modalShipping">
        <div class="modal">
          <h3 class="modal_title">배송요청사항</h3>
          <textarea class="modal_content h200" readonly><?= $delivery_comment ?></textarea>
          <button class="modal_close">확인</button>
        </div>
      </div>

      <div class="match_status match_box">
        <ul>
          <li class="li_title">매칭현황</li>
          <li class="li_content"><?= $status ?></li>
        </ul>
        <form action="match_status.php?id=<?= $_GET['id'] ?>" method="post" id="match_status">
          <select name="match_status" id="match_select">
            <option value="매칭대기" <?php if ($status === "매칭대기") {
              echo "selected";
            } ?>>매칭대기
            </option>
            <option value="매칭진행" <?php if ($status === "매칭진행") {
              echo "selected";
            } ?>>매칭진행
            </option>
            <option value="매칭완료" <?php if ($status === "매칭완료") {
              echo "selected";
            } ?>>매칭완료
            </option>
            <option value="매칭취소" <?php if ($status === "매칭취소") {
              echo "selected";
            } ?>>매칭취소
            </option>
          </select>
          <button type="submit" class="match_status_submit mr6">수정</button>
          <?php
          if ($status == '매칭취소') {
            ?>
            <button type="button" class="match_status_submit gray wauto" onclick="openModal('Cancle')">취소사유</button>
            <?php
          }
          ?>
        </form>
      </div>
      <div class="modal_window modalCancle">
        <div class="modal">
          <h3 class="modal_title">취소사유</h3>
          <textarea class="modal_content h200" readonly><?= $cancel_comment ?></textarea>
          <button class="modal_close">확인</button>
        </div>
      </div>

      <div class="match_content match_box">
        <p class="li_title">내용</p>
        <div class="match_content_inner"><?= $content ?></div>
        <p class="li_title">사진</p>
        <div class="match_photos">
          <?php
          $dir = "../uploads/transfer/" . $u_id . '/' . $image_path;
          if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
              while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") { ?>
                  <img class="match_photo wauto" src="<?= $dir . "/" . $file ?>">
                  <?php
                }
              }
              closedir($dh);
            }
          }
          ?>
        </div>
      </div>
      <!-- match_content -->

      <div class="match_counsel">
        <h2 class="content_title">상담현황</h2>
        <button class="btn_counsel" onclick="openModal('Counsel')">상담등록</button>
        <table class="match_table">
          <thead>
          <tr>
            <th>상담시간</th>
            <th>신청자</th>
            <th>상담자</th>
            <th>상담방식</th>
            <th>상담내용</th>
            <th>비고</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $c_pageNum = 2;
          $sql = "SELECT c.*, ui.name,
                  (SELECT name FROM cm_user_info AS ui WHERE c.ua_id = ui.u_id) AS a_name
                  FROM cm_consult AS c
                  JOIN cm_user_info AS ui ON c.u_id = ui.u_id AND c.m_id = '{$_GET['id']}'
                  ORDER BY c.id DESC";
          $result = myQuery($sql);
          $c_pageTotal = mysqli_num_rows($result);
          $c_p = $_GET['c_p'];
          if (empty($c_p)) {
            $c_p = 0;
          } elseif ($c_p < 0) {
            $c_p = 0;
          } elseif ($c_p > $c_pageTotal) {
            $c_p = $c_p - 2;
          }
          $sql = "SELECT c.*, ui.name,
                  (SELECT name FROM cm_user_info AS ui WHERE c.ua_id = ui.u_id) AS a_name
                  FROM cm_consult AS c
                  JOIN cm_user_info AS ui ON c.u_id = ui.u_id AND c.m_id = '{$_GET['id']}'
                  ORDER BY c.id DESC LIMIT {$c_p}, {$c_pageNum}";
          $result = myQuery($sql);

          while ($row = mysqli_fetch_array($result)) {
            $date = date_create($row['date']);
            ?>
            <tr>
              <td><?= date_format($date, "Y.m.d H:i") ?></td>
              <td class="underbar"><a href="./userList.php?id=<?= $row['u_id'] ?>"><?= $row['name'] ?></a></td>
              <td><?= $row['a_name'] ?></td>
              <td><?= $row['category'] ?></td>
              <td class="detail">
                <button class="btn_detail counselMore">보기</button>
              </td>
              <td>
                <div class="etc"><?= $row['memo'] ?></div>
              </td>
            </tr>

            <tr class="counsel_look">
              <form action="consult_update.php?id=<?= $row['id'] ?>" method="post">
                <td colspan="6">
                  <textarea name="content"><?= $row['content'] ?></textarea>
                  <div class="btn_wrap">
                    <button type="button" class="block cancel">
                      <a href="consult_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('상담을 삭제하시겠습니까?');" style="color: #fff">삭제</a>
                    </button>
                    <button type="submit" class="match_status_submit">수정</button>
                  </div>
                </td>
              </form>
            </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
        <?php
        if ($date) {
          ?>
          <div class="page">
            <ul>
              <a href='/admin/match.php?id=<?= $_GET['id'] ?>&c_p=<?php
              if ($c_p <= 0) {
                echo $c_p;
              } else {
                echo $c_p - 2;
              }
              ?>'>
                <li class="page-left">&lt;</li>
              </a>
              <?php
              $id = $_GET['id'];
              $c_pages = ceil($c_pageTotal / $c_pageNum);
              $c_pageGroup = ceil($c_pages / 10);
              $c_pageCount = ceil(ceil($c_pages / $c_pageGroup) / 10) * 10;
              $c_pageEnd = ceil($c_pageTotal / 20) * 20 - 2;

              for ($j = 1; $j < $c_pageGroup + 1; $j++) {
                if ($c_p < 20) {
                  $c_Count = 1;
                } elseif ($c_p <= $c_pageEnd - (20 * ($j - 1))) {
                  $c_Count = 1 + (10 * $c_pageGroup) - (10 * $j);
                }
              }

              for ($i = $c_Count; $i - $c_Count < $c_pageCount; $i++) {
                $c_nextPage = $c_pageNum * ($i - 1);
                $c_activePage = $_GET['c_p'] / 2 + 1;
                $className = '';
                if ($c_activePage == $i) {
                  $className = 'page-on';
                }
                echo "<a href='$_SERVER[PHP_SELF]?id=$id&c_p=$c_nextPage";

                echo "'><li class='$className'>$i</li></a>";

                if ($i >= $c_pages) {
                  $i = $c_pages;
                  break;
                }
              }
              ?>
              <a href='/admin/match.php?id=<?= $_GET['id'] ?>&c_p=<?php
              if ($c_p + 2 >= $c_pageTotal) {
                echo $c_p;
              } else {
                echo $c_p + 2;
              }
              ?>'>
                <li class="page-right">&gt;</li>
              </a>
            </ul>
          </div>
          <?php
        }
        ?>
        <!-- page -->
      </div>
      <!-- match_counsel -->
      <div class="modal_window modalCounsel">
        <div class="modal">
          <form action="consult_create.php?id=<?= $_GET['id'] ?>" method="post">
            <h3 class="modal_title">상담내용작성</h3>
            <div class="modal_section">
              <h3 class="modal_title pr15">신청자</h3>
              <select name="u_id" class="select_basic">
                <option value="<?= $u_id ?>"><?= $name ?></option>
                <option value="<?= $m_u_id ?>"><?= $m_name ?></option>
              </select>
            </div>
            <div class="modal_section">
              <h3 class="modal_title">상담방식</h3>
              <select name="category" class="select_basic">
                <option value="전화">전화</option>
                <option value="이메일">이메일</option>
                <option value="면담">면담</option>
                <option value="기타">기타</option>
              </select>
            </div>
            <textarea class="modal_content" name="content"></textarea>
            <div class="array">
              <button type="button" class="modal_close">취소</button>
              <button type="submit" class="modal_close">상담등록</button>
            </div>
          </form>
        </div>
      </div>
      <!-- modalCounsel -->

      <div class="match_work">
        <h2 class="content_title">업무현황</h2>
        <button class="btn_counsel" onclick="openModal('Work')">업무등록</button>
        <table class="match_table">
          <thead>
          <tr>
            <th>구분</th>
            <th>메모</th>
            <th>업무시간</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $b_pageNum = 2;
          $sql = "SELECT * FROM cm_business_status WHERE m_id = '{$_GET['id']}' ORDER BY id DESC";
          $result = myQuery($sql);
          $b_pageTotal = mysqli_num_rows($result);
          $b_p = $_GET['b_p'];
          if (empty($b_p)) {
            $b_p = 0;
          } elseif ($b_p < 0) {
            $b_p = 0;
          } elseif ($b_p > $b_pageTotal) {
            $b_p = $b_p - 2;
          }
          $sql = "SELECT * FROM cm_business_status WHERE m_id = '{$_GET['id']}' ORDER BY id DESC LIMIT {$b_p}, {$b_pageNum}";
          $result = myQuery($sql);

          while ($row = mysqli_fetch_array($result)) {
            $date = date_create($row['date']);
            ?>
            <tr>
              <td><?= $row['category'] ?></td>
              <td><?= $row['memo'] ?></td>
              <td><?= date_format($date, 'Y.m.d H:i') ?></td>
            </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
        <div class="page">
          <ul>
            <a href='/admin/match.php?id=<?= $_GET['id'] ?>&b_p=<?php
            if ($b_p <= 0) {
              echo $b_p;
            } else {
              echo $b_p - 2;
            }
            ?>'>
              <li class="page-left">&lt;</li>
            </a>
            <?php
            $id = $_GET['id'];
            $b_pages = ceil($b_pageTotal / $b_pageNum);
            $b_pageGroup = ceil($b_pages / 10);
            $b_pageCount = ceil(ceil($b_pages / $b_pageGroup) / 10) * 10;
            $b_pageEnd = ceil($b_pageTotal / 20) * 20 - 2;

            for ($j = 1; $j < $b_pageGroup + 1; $j++) {
              if ($b_p < 20) {
                $b_Count = 1;
              } elseif ($b_p <= $b_pageEnd - (20 * ($j - 1))) {
                $b_Count = 1 + (10 * $b_pageGroup) - (10 * $j);
              }
            }

            for ($i = $b_Count; $i - $b_Count < $b_pageCount; $i++) {
              $b_nextPage = $b_pageNum * ($i - 1);
              $b_activePage = $_GET['b_p'] / 2 + 1;
              $className = '';
              if ($b_activePage == $i) {
                $className = 'page-on';
              }
              echo "<a href='$_SERVER[PHP_SELF]?id=$id&b_p=$b_nextPage";

              echo "'><li class='$className'>$i</li></a>";

              if ($i >= $b_pages) {
                $i = $b_pages;
                break;
              }
            }
            ?>
            <a href='/admin/match.php?id=<?= $_GET['id'] ?>&b_p=<?php
            if ($b_p + 2 >= $b_pageTotal) {
              echo $b_p;
            } else {
              echo $b_p + 2;
            }
            ?>'>
              <li class="page-right">&gt;</li>
            </a>
          </ul>
        </div>
        <!-- page -->
      </div>
      <!-- match_work -->
      <div class="modal_window modalWork">
        <div class="modal">
          <form action="business_create.php?id=<?= $_GET['id'] ?>" method="post">
            <h3 class="modal_title">업무등록</h3>
            <div class="modal_section">
              <h3 class="modal_title">구분</h3>
              <select name="category" class="select_basic">
                <option value="연락">연락</option>
                <option value="배송완료">배송완료</option>
              </select>
            </div>
            <div class="modal_section">
              <h3 class="modal_title">메모</h3>
              <textarea class="modal_content" name="memo"></textarea>
            </div>
            <div class="array">
              <button type="button" class="modal_close">취소</button>
              <button type="submit" class="modal_close">업무등록</button>
            </div>
          </form>
        </div>
      </div>
      <!-- modalWork -->

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