// Modal창 열기
function openModal(num) {
  $(".modal" + num).css("display", "flex");

  $(".modal_close").click(function () {
    $(".modal" + num).css("display", "none");
  });
}
