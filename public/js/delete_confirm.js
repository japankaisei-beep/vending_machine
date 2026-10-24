document.querySelectorAll('.js-delete-button').forEach(function (button) {
    button.addEventListener('click', function (event) {
        if (!confirm('本当に削除しますか？')) {
            event.preventDefault();
        }
    });
});
