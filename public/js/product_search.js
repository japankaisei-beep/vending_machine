$(function () {
    $('.product-search').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'GET',
            data: $(this).serialize(),
            dataType: 'html',
        })
            .done(function (html) {
                $('.js-product-list-body').html(html);
                $('.product-list__table').trigger('update');
            })
            .fail(function () {
                alert('検索に失敗しました。');
            });
    });
});
