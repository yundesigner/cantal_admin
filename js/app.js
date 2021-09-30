const modal = document.getElementById("modal");
const btnModal = document.getElementById("btn-modal");
btnModal.addEventListener("click", (e) => {
  modal.style.display = "flex";
});
const closeBtn = modal.querySelector(".modal_close");
closeBtn.addEventListener("click", (e) => {
  modal.style.display = "none";
});
