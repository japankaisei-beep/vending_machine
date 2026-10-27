$(function () {
    $(document).on('click', '.js-delete-button', function (event) {
        if (!confirm('本当に削除しますか？')) {
            event.preventDefault();
        }
    });
});
