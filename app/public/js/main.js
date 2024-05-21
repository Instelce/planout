

function toggleModal(id) {
  const modal = document.querySelector(`#m${id.toString()}`);

  modal.classList.toggle("show");
}

let modalsContainer = document.querySelectorAll(".modal-container");

modalsContainer.forEach(container => {
  let div = document.createElement('div');
  div.classList.add('close')
  let id = container.id.at(1);
  div.addEventListener('click', () => toggleModal(id));
  container.appendChild(div);
})