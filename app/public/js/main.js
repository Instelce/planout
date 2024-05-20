

function toggleModal(id) {
  const modal = document.querySelector(`#m${id.toString()}`);

  modal.classList.toggle("show");
}