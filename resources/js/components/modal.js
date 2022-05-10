function showModalForm(event, textToReplace = 'id') {
    let button = event.relatedTarget;
    let form = event.target.querySelector('form');
    let modelId = button.getAttribute('data-bs-model');

    if (! modelId) {
        return;
    }

    if (!form.action.includes(textToReplace)) {
        textToReplace = /\d+/g;
    }

    form.action = form.action.replace(textToReplace, modelId);
}

let restoreModal = document.getElementById('restoreModal');
let deleteModal = document.getElementById('deleteModal');

deleteModal.addEventListener('show.bs.modal', showModalForm);
restoreModal.addEventListener('show.bs.modal', showModalForm);
