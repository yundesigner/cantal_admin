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

        (SELECT m.id, ui.name AS m_name, ui.phone AS m_phone, ui.address AS m_address, ui.address_detail AS m_address_detail
        FROM cm_matching AS m
        JOIN cm_user_info AS ui ON m.u_id = ui.u_id AND m.id = '{$_GET['id']}') AS b ON a.id = b.id

        LEFT JOIN

        (SELECT m.id, p.name AS p_name, p.phone AS p_phone, p.company_name AS p_company_name
        FROM cm_matching AS m
        JOIN cm_partner AS p ON m.p_id = p.id AND m.id = '{$_GET['id']}') AS c ON a.id = c.id";

$result = myQuery($sql);
$row = mysqli_fetch_array($result);

$u_id = $row['u_id'];
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
          var company = $('#company_name opation:selected').val();
          $.get('get_cate.php?type=1&company=' + company, show_cates1);
          console.log(company);
        }

        function show_cates1(res) {
          $('#p_name').html(res);
          $('#p_phone').html("");
        }

        function update_cate2() {
          var company = $('#company_name option:selected').val();
          var p_name = $('#p_name option:selected').val();
          $.get('get_cate.php?type=2&company=' + company + '&p_name=' + p_name, show_cates2);
        }

        function show_cates2(res2) {
          $('#p_phone').html(res2);
        }
      </script>

      <div class="modal_window modalPartner">
        <div class="modal">
          <form action="">
            <div class="modal_in">
              <h3 class="modal_title fw800">파트너등록</h3>
              <div class="modal_section">
                <h3 class="modal_title">업체이름</h3>
                <select id="company_name" name="company_name" class="select_basic" onchange="update_cate1();">
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
                <input type="text" id="p_phone" class="modal_content" value="">
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
        <form action="" id="match_status">
          <select name="match_status" id="match_select">
            <option value="matchcheck">매칭대기</option>
            <option value="matchprogress">매칭진행</option>
            <option value="matchcomplete">매칭완료</option>
            <option value="matchcancel">매칭취소</option>
          </select>
          <button type="submit" class="match_status_submit mr6">수정</button>
          <button type="button" class="match_status_submit gray wauto" onclick="openModal('Cancle')">취소사유</button>
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
          <tr>
            <td>2021.07.12 10:55</td>
            <td class="underbar">홍길동</td>
            <td class="underbar">이캔탈</td>
            <td>전화</td>
            <td class="detail">
              <button class="btn_detail counselMore">보기</button>
            </td>
            <td>
              <div class="etc"></div>
            </td>
          </tr>
          <tr class="counsel_look">
            <td colspan="6">
              <textarea></textarea>
              <div class="btn_wrap">
                <button class="block cancel">삭제</button>
                <button type="submit" class="match_status_submit">수정</button>
              </div>
            </td>
          </tr>

          <tr>
            <td>2021.08.12 13:01</td>
            <td class="underbar">홍길동</td>
            <td class="underbar">이캔탈</td>
            <td>전화</td>
            <td class="detail">
              <button class="btn_detail counselMore">보기</button>
            </td>
            <td>
              <div class="etc"></div>
            </td>
          </tr>
          <tr class="counsel_look">
            <td colspan="6">
              <textarea></textarea>
              <div class="btn_wrap">
                <button class="block cancel">삭제</button>
                <button type="submit" class="match_status_submit">수정</button>
              </div>
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
          <div class="modal_section">
            <h3 class="modal_title pr15">신청자</h3>
            <form action="" id="counselUser_section">
              <select name="counselUser_section" class="select_basic">
                <option value=""></option>
                <option value=""></option>
              </select>
            </form>
          </div>
          <div class="modal_section">
            <h3 class="modal_title">상담방식</h3>
            <form action="" id="counselWay_section">
              <select name="counselUser_section" class="select_basic">
                <option value="call">전화</option>
                <option value="email">이메일</option>
                <option value="interview">면담</option>
                <option value="etc">기타</option>
              </select>
            </form>
          </div>
          <textarea class="modal_content"></textarea>
          <div class="array">
            <button class="modal_close">취소</button>
            <button class="modal_close">상담등록</button>
          </div>
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
          <tr>
            <td>연락</td>
            <td></td>
            <td>2021.08.12 13:01</td>
          </tr>

          <tr>
            <td>배송완료</td>
            <td></td>
            <td class="">2021.08.12 13:01</td>
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
      <!-- match_work -->
      <div class="modal_window modalWork">
        <div class="modal">
          <h3 class="modal_title">업무등록</h3>
          <div class="modal_section">
            <h3 class="modal_title">구분</h3>
            <form action="" id="work_section">
              <select name="work_section" class="select_basic">
                <option value="contact">연락</option>
                <option value="shipsucess">배송완료</option>
              </select>
            </form>
          </div>
          <div class="modal_section">
            <h3 class="modal_title">메모</h3>
            <textarea class="modal_content"></textarea>
          </div>
          <div class="array">
            <button class="modal_close">취소</button>
            <button class="modal_close">업무등록</button>
          </div>
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