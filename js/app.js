// Modal창 열기
function openModal(num) {
  $(".modal" + num).css("display", "flex");

  $(".modal_close").click(function () {
    $(".modal" + num).css("display", "none");
  });
}

// 댓글 카운터

const comment = document.querySelector("tbody");
const eleCount = comment.childElementCount;

window.onload = function countComment() {
  const count = document.querySelector(".comment_counter");
  count.innerHTML = "총 " + eleCount + "개";
};
