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
            })
            .fail(function () {
                alert('検索に失敗しました。');
            });
    });
});
