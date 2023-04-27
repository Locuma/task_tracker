function updateRecord(element, userId) {
    let roleId = element.value;
    $.ajax({
        url: '/site/update-role',
        type: 'POST',
        data: {
            userId: userId,
            roleId: roleId,
        },
        success: function (data) {
            alert(data);
        },
        error: function (xhr) {
            let errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Ошибка - ' + errorMessage);
        },
    });

}