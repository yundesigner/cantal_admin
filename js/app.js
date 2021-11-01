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
    parentTr.next('.counsel_look').toggleClass('dtr')
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
  // const answerAddBtn = document.querySelector('.answerAddBtn');
  answerBox.style.display = 'block';
  // answerAddBtn.style.display = 'none';
}
