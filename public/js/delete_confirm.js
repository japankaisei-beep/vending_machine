$(function () {
    $(document).on('click', '.js-delete-button', function (event) {
        event.preventDefault();

        if (!confirm('本当に削除しますか？')) {
            return;
        }

        const form = $(this).closest('form');
        const row = $(this).closest('tr');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
        })
            .done(function () {
                row.remove();
                $('.product-list__table').trigger('update');
            })
            .fail(function () {
                alert('商品の削除に失敗しました。');
            });
    });
});
