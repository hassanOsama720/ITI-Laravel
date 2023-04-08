let deleteButtons = document.querySelectorAll('#deleteButton');
let postId = document.querySelector('#postId');

function deletePost() {
    let id = this.dataset.id;
    postId.innerHTML = id;
}
