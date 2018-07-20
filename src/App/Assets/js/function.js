function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var formdata = new FormData();
    $.map(unindexed_array, function (n, i) {
        formdata.append(n['name'], n['value']);
    });
    return formdata;
}

function popError(title, message) {
    $(".ui.modal").remove();
    var modal = '<div class="ui modal">' +
        '           <i class="close icon"></i>' +
        '  <div class="header">' +
        title +
        ' </div>' +
        ' <div class="image content">' +
        '       <div class="description">' +
        message +
        '       </div>' +
        '        </div>' +
        '        <div class="actions">' +
        ' <div class="ui negative button">OK</div>' +
        ' </div>' +
        ' </div> ';
    $("body").append(modal);
    $('.ui.modal').modal('show');
}

function popRemove(title, message, acao) {
    $(".ui.modal").remove();
    var modal = '<div class="ui modal">' +
        '   <i class="close icon"></i>' +
        '  <div class="header">' +
        title +
        ' </div>' +
        ' <div class="image content">' +
        '       <div class="description">' +
        message +
        '       </div>' +
        '        </div>' +
        '   <div class="actions">' +
        '  <div class="ui green basic ok button"><i class="checkmark icon"></i>Sim</div>' +
        '  <div class="ui red basic cancel button"><i class="remove icon"></i>Não</div>' +
        '   </div>' +
        ' </div> ';
    $("body").append(modal);
    $('.ui.modal')
        .modal({
            closable: false,
            onDeny: function () {
                $('.ui.modal').modal('hide');
                return false;
            },
            onApprove: function () {
                if (typeof (acao) == "function")
                   return acao.call();
            }
        })
        .modal('show')
}