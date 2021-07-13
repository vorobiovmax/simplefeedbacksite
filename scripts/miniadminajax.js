function ajaxRefresh(csrfToken) {
    $.ajax({
        type: 'POST',
        url: '/application/controllers/ajaxminiadmin.php',
        data: {
            isAjax: true,
            action: 'refresh',
            csrfToken: csrfToken
        },
        success: function (data) {
            $('.stories-table').find('tbody').html(data);
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
}

function ajaxDelete(formId, pageCsrfToken) {
    $.ajax({
        type: 'POST',
        url: '/application/controllers/ajaxminiadmin.php',
        data: {
            isAjax: true,
            action: 'delete',
            formId: formId,
            csrfToken: pageCsrfToken
        },
        success: function (data) {
            ajaxRefresh(pageCsrfToken);
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
}


function moveToFormEditPage(formId) {
    $(location).attr('href', '/formedit.php?formId=' + formId);
}