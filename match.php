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
        <h2 class="content_title">매칭 상세보기</h2>
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

        <div class="match_person">
          <div class="match_user">
            <ul class="match_user_writer match_box">
              <li class="li_title">작성자</li>
              <li class="li_content">홍길동</li>
              <li class="li_title">연락처</li>
              <li class="li_content">010-1234-5678</li>
              <li class="li_title">주소</li>
              <li class="li_content">부산광역시 서구 동대신동 1번지</li>
            </ul>
            <ul class="match_user_volunteer match_box">
              <li class="li_title">신청자</li>
              <li class="li_content">박철수</li>
              <li class="li_title">연락처</li>
              <li class="li_content">010-1234-5678</li>
              <li class="li_title">주소</li>
              <li class="li_content">부산광역시 서구 동대신동 1번지</li>
            </ul>
            <ul class="match_user_volunteer match_box">
              <li class="li_title">수령자</li>
              <li class="li_content">박철수</li>
              <li class="li_title">연락처</li>
              <li class="li_content">010-1234-5678</li>
              <li class="li_title">주소</li>
              <li class="li_content">부산광역시 서구 동대신동 1번지</li>
              <li class="li_title">배송가능일</li>
              <li class="li_content">2021.10.25 ~ 2021.10.25</li>
            </ul>
          </div>
          <div class="match_partner match_box">
            <div class="partner_info">
              <ul>
                <li class="li_title">파트너</li>
                <li class="li_content">김영희</li>
              </ul>
              <ul>
                <li class="li_title">연락처</li>
                <li class="li_content">010-1234-5678</li>
              </ul>
              <ul>
                <li class="li_title">업체</li>
                <li class="li_content">웅진코웨이</li>
                <button type="submit" class="match_status_submit gray" onclick="openModal('Partner')">수정</button>
              </ul>
            </div>
            <img src="./images/patch_partner.png" class="remove_prev" onclick="openModal('Partner')">
          </div>
        </div>
        <!-- match_person -->
        <div class="modal_window modalPartner">
          <div class="modal">
            <div class="modal_in">
              <h3 class="modal_title fw800">파트너등록</h3>
              <div class="modal_section">
                <h3 class="modal_title">업체이름</h3>
                <form action="" id="partner_section">
                  <select name="partner_section" class="select_basic">
                    <option value=""></option>
                    <option value=""></option>
                  </select>
                </form>
              </div>
              <div class="modal_section">
                <h3 class="modal_title">이름</h3>
                <form action="" id="partnerName_section">
                  <select name="partnerName_section" class="select_basic">
                    <option value=""></option>
                    <option value=""></option>
                  </select>
                </form>
              </div>
              <div class="modal_section">
                <h3 class="modal_title">연락처</h3>
                <input type="number" class="modal_content"></input>
              </div>
            </div>
            <div class="array">
              <button class="modal_close">취소</button>
              <button class="modal_close partner_add" onclick="partnerAdd();">등록</button>
            </div>
          </div>
        </div>
        <!-- modalWork -->

        <div class="match_status match_box">
          <ul>
            <li class="li_title">매칭현황</li>
            <li class="li_content">매칭대기</li>
          </ul>
          <form action="" id="match_status">
            <select name="match_status" id="match_select">
              <option value="matchcheck">매칭검토</option>
              <option value="matchprogress">매칭진행</option>
              <option value="matchcomplete">매칭완료</option>
              <option value="matchcancel">매칭취소</option>
            </select>
            <button type="submit" class="match_status_submit">수정</button>
          </form>
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