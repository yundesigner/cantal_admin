// 로그인 창
function login(){
  const login = document.querySelector('.login');
  const loginId = document.getElementsByName('loginId')[0].value;
  const loginPw = document.getElementsByName('loginPw')[0].value;

  if(loginId.length > 3 && loginPw.length > 7){
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
// 토글
const counselToggle = document.querySelectorAll('.btn_detail');

var toggleTrue = true;

for(var i=0; i < counselToggle.length; i++){
  counselToggle[i].addEventListener('click', function(){ 
    const parentTr = $(this).parents('tr')
  
    if(toggleTrue){
      $('<tr class="counsel_look"><td colspan="7"><textarea></textarea><div class="btn_wrap"><button class="block cancel">삭제</button><button type="submit" class="match_status_submit">수정</button></div></td></tr>').insertAfter(parentTr);
    }else{
      parentTr.next().css('display', 'none')
    }
    toggleTrue = !toggleTrue
  })
}