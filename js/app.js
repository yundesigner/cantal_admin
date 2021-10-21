// document.addEventListener("DOMContentLoaded", function(){
// });


// 로그인 창
function login() {
  const login = document.querySelector('.login');
  const loginId = document.getElementsByName('loginId')[0].value;
  const loginPw = document.getElementsByName('loginPw')[0].value;

  if (loginId.length > 3 && loginPw.length > 7) {
    login.style.display = 'none'
  }
}

// Modal창 열기
function openModal(num) {
  $(".modal" + num).css("display", "flex");
  $(".modal_close").click(function () {
    $(".modal" + num).css("display", "none");
  });
}

// 매칭관리 - 상담내용
// 파트너 등록하기
function partnerAdd() {
  const removePrev = document.querySelector('.remove_prev');
  const partnerInfo = document.querySelector('.partner_info');

  partnerInfo.style.display = 'block';
  removePrev.style.display = 'none';
}

// 파트너 사진 업로드
$("#upload, #answer_img").on('change', function () {
  var fileName = $("#upload, #answer_img").val();
  $(".upload_name, .upload_user").text(fileName);
});

// 토글
const counselToggle = document.querySelectorAll('.counselMore');

for (var i = 0; i < counselToggle.length; i++) {
  counselToggle[i].addEventListener('click', function () {
    const parentTr = $(this).parents('tr')
    parentTr.next('.counsel_look').css('display', 'table-row')
  })
}

// 유저관리 - 이동
const goToMatch = document.querySelectorAll('.goToMatch')

for (var i = 0; i < goToMatch.length; i++) {
  goToMatch[i].addEventListener('click', function () {
    location.href = "./../admin/match.php"
  })
}

// 답변등록
function answerAdd() {
  const answerBox = document.querySelector('.answerBox');
  const answerAddBtn = document.querySelector('.answerAddBtn');
  answerBox.style.display = 'block';
  answerAddBtn.style.display = 'none';
}

// 답변삭제
function answerRemove() {
  const answerBox = document.querySelector('.answerBox');
  const answerAddBtn = document.querySelector('.answerAddBtn');
  answerBox.style.display = 'none';
  answerAddBtn.style.display = 'block';
}

// 앱관리/배너관리 - 수정
const bannerWrap = document.querySelector('.banner_wrap');

function appBannerEdit() {
  const appBanner = document.querySelector('.banner_in');
  appBanner.remove();
  $('<div class="match_form banner_submit"><h2 class="content_title">배너관리 등록하기</h2><div class="match_title match_box"><ul><li class="li_title">제목</li><li class="li_content mr0"><input type="text"></input></li></ul></div><div class="match_person"><div class="match_user"><ul class="match_user_writer match_box"><li class="li_title">이미지</li><li class="li_content upload mr0"><label for="answer_img"><img src="./images/icon_upload.png" alt="icon_upload"></label><input type="file" id="answer_img" class="dn"></input></li></ul><ul class="match_user_writer match_box"><li class="li_title">기간</li><li class="li_content df mr0"><input type="date" value="2021-10-01" /><p>~</p><input type="date" value="2021-10-01" /></li></ul></div><div class="match_partner match_box dn"></div></div><div class="match_content match_box"><p class="li_title mb15">내용</p><textarea class="match_content_inner fwb fs16"></textarea></div><div class="df_jsb"><a href="./appmanage.php"><button class="block black">목록보기</button></a><div class="btn_wrap"><button class="block" onclick="appBannerSubmit()">등록</button></div></div></div>').appendTo(bannerWrap);
}

// 앱관리/배너관리 - 등록
function appBannerSubmit() {
  const bannerSubmit = document.querySelector('.banner_submit');
  bannerSubmit.remove();
  $('<div class="match_form banner_in"><h2 class="content_title">배너관리</h2><div class="match_title match_box"><ul><li class="li_title">제목</li><li class="li_content mr0"><p>이벤트제목</p><p class="li_date">2021.08.12</p></li></ul></div><div class="match_person"><div class="match_user"><ul class="match_user_writer match_box"><li class="li_title">작성자</li><li class="li_content mr0">홍길동</li></ul><ul class="match_user_writer match_box"><li class="li_title">작성일</li><li class="li_content mr0">2021.08.12</li></ul><ul class="match_user_writer match_box"><li class="li_title">기간</li><li class="li_content mr0">2021.08.12~2021.08.18</li></ul></div><div class="match_partner match_box dn"></div></div><div class="df"><div class="match_content match_box"><p class="li_title">이미지</p><div class="img_area"></div></div><div class="match_content match_box"><p class="li_title">내용</p><textarea class="match_content_inner fwb fs16" readonly></textarea></div></div><div class="df_jsb"><a href="./appmanage.php"><button class="block black">목록보기</button></a><div class="btn_wrap"><button class="block orange">삭제</button><button class="block" onclick="appBannerEdit()">수정</button></div></div><div class="modal_window modalAnswer"><div class="modal"><h3 class="modal_title">답변내용첨부</h3><textarea class="modal_content"></textarea><div class="df"><h3 class="modal_title">이미지첨부</h3><label for="answer_img"><img src="./images/icon_upload.png" alt="icon_upload"></label><input type="file" id="answer_img" class="dn"></input></div><div class="array"><button class="modal_close">취소</button><button class="modal_close" onclick="answerAdd();">답변등록</button></div></div></div></div>').appendTo(bannerWrap);
}

// 앱관리/공지사항관리 - 수정
function appNoticeEdit(){
  const appBanner = document.querySelector('.banner_in');
  appBanner.remove();
  $('<div class="match_form banner_submit"><h2 class="content_title">공지사항 등록하기</h2><div class="match_title match_box"><ul><li class="li_title">제목</li><li class="li_content mr0"><input type="text"></input></li></ul></div><div class="match_content match_box"><p class="li_title mb15">내용</p><textarea class="match_content_inner fwb fs16"></textarea></div><div class="df_jsb"><a href="./appNotice.php"><button class="block black">목록보기</button></a><div class="btn_wrap"><button class="block" onclick="appNoticeSubmit()">등록</button></div></div></div>').appendTo(bannerWrap);
}

// 앱관리/공지사항관리 - 등록
function appNoticeSubmit() {
  const bannerSubmit = document.querySelector('.banner_submit');
  bannerSubmit.remove();
  $('<div class="match_form banner_in"><h2 class="content_title">공지사항</h2><div class="match_title match_box"><ul><li class="li_title">제목</li><li class="li_content mr0"><p>이벤트제목</p><p class="li_date">2021.08.12</p></li></ul></div><div class="match_person"><div class="match_user"><ul class="match_user_writer match_box"><li class="li_title">작성자</li><li class="li_content mr0">관리자</li></ul><ul class="match_user_writer match_box"><li class="li_title">작성일</li><li class="li_content mr0">2021.08.12</li></ul></div><div class="match_partner match_box dn"></div></div><div class="match_content match_box"><p class="li_title mb15">내용</p><textarea class="match_content_inner fwb fs16" readonly></textarea></div><div class="df_jsb"><a href="./appNotice.php"><button class="block black">목록보기</button></a><div class="btn_wrap"><button class="block orange">삭제</button><button class="block" onclick="appNoticeEdit()">수정</button></div></div></div>').appendTo(bannerWrap);
}