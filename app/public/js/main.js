
// drag and drop for kanban
const kanbanCards = document.querySelectorAll('.kanban-card');
const containers = document.querySelectorAll('.kanban-column');

kanbanCards.forEach(draggable => {
  draggable.addEventListener('dragstart', () => {
    draggable.classList.add('dragging');
  })

  draggable.addEventListener('dragend', () => {
    draggable.classList.remove('dragging');
  })
})

function getDragAfterElement(container, y) {
  const draggableElements = [...container.querySelectorAll('.kanban-card:not(.dragging)')];
  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect();
    const offset = y - box.top - box.height / 2;
    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child };
    } else {
      return closest;
    }
  }, { offset: Number.NEGATIVE_INFINITY }).element;
}

containers.forEach(container => {
  const dragZone = container.querySelector('.kanban-column-content');

  dragZone.addEventListener('dragover', e => {
    e.preventDefault();

    const afterElement = getDragAfterElement(dragZone, e.clientY);
    const draggable = document.querySelector('.dragging');

    if (afterElement == null) {
      dragZone.appendChild(draggable);
    } else {
      dragZone.insertBefore(draggable, afterElement);
    }
  })

  dragZone.addEventListener('dragenter', e => {
    e.preventDefault();
    container.classList.add('card-over');
  })

  dragZone.addEventListener('dragleave', e => {
    e.preventDefault();
    container.classList.remove('card-over');
  })

  dragZone.addEventListener('drop', e => {
    e.preventDefault();

    const afterElement = getDragAfterElement(dragZone, e.clientY);
    const draggable = document.querySelector('.dragging');

    if (afterElement == null) {
      dragZone.appendChild(draggable);
    } else {
      dragZone.insertBefore(draggable, afterElement);
    }

    container.classList.remove('card-over');

    let cardId = draggable.getAttribute('data-id');
    let projectId = draggable.getAttribute('data-project');
    let kanbanId = draggable.getAttribute('data-kanban');
    let currentColumnId = draggable.getAttribute('data-column');
    let newColumnId = container.getAttribute('data-id')

    let cards = Array.from(container.querySelectorAll('.kanban-card'));
    let pos = 0;
    let cardModified;
    cards.forEach((card, i) => {
      if (card.classList.contains('dragging')) {
        pos = i;
        cardModified = card
      }
    })

    cardModified.setAttribute('data-column', newColumnId);
    let currentColumnCards = Array.from(Array.from(document.querySelectorAll(`.kanban-column`)).filter(c => c.getAttribute('data-id') === currentColumnId)[0].querySelectorAll('.kanban-card'))

    if (currentColumnId !== newColumnId) {
      console.log("Reset")
      currentColumnCards.forEach((card, i) => {
        console.log(i, currentColumnId)
        fetch(`/projects/${projectId}/kanban/${kanbanId}/card/${card.getAttribute('data-id')}/update?col=${currentColumnId}&pos=${i}`, {
          method: 'post',
        })
      })
    }

    fetch(`/projects/${projectId}/kanban/${kanbanId}/card/${cardId}/update?col=${newColumnId}&pos=${pos}`, {
      method: 'post',
      body: JSON.stringify({
        position: pos,
        kanban_column: parseInt(newColumnId)
      }),
    })

    cards.forEach((card, i) => {
      fetch(`/projects/${projectId}/kanban/${kanbanId}/card/${card.getAttribute('data-id')}/update?col=${newColumnId}&pos=${i}`, {
        method: 'post',
      })
    })
  })
})


// modals management
function toggleModal(id, url, atarget) {
  const modal = document.querySelector(`#m${id.toString()}`);

  modal.classList.toggle("show");
  if (url && atarget) {
    const a = document.querySelector(`.${atarget}`);
    a.href = url;
  }

}

let modalsContainer = document.querySelectorAll(".modal-container");

modalsContainer.forEach(container => {
  let div = document.createElement('div');
  div.classList.add('close')
  let id = container.id.at(1);
  div.addEventListener('click', () => toggleModal(id));
  container.appendChild(div);
})


// for kanban page
const kanbanGrid = document.querySelector('.kanban-grid');
const newColumnButton = document.querySelector('.new-column-button');
const newColumnForm = document.querySelector('.new-column-form');

newColumnButton.addEventListener('click', () => {
  newColumnForm.classList.add('show');
  newColumnButton.classList.add('hide');

  kanbanGrid.scrollTo(kanbanGrid.scrollWidth, 0)

  const closeButton = newColumnForm.querySelector('.close');
  closeButton.addEventListener('click', () => {
    newColumnForm.classList.remove('show');
    newColumnButton.classList.remove('hide');
  })
})

const kanbanColumns = document.querySelectorAll('.kanban-column');

kanbanColumns.forEach(column => {
  const newCardButton = column.querySelector('.new-card');
  const newCardForm = column.querySelector('.new-card-form');

  newCardButton.addEventListener('click', () => {
    newCardForm.classList.add('show');
  })
})
