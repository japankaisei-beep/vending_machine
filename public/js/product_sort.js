$(function () {
    $('.product-list__table').tablesorter({
        theme: 'default',
        sortList: [[0, 1]],
        headers: {
            1: { sorter: false },
            6: { sorter: false },
        },
    });
});
