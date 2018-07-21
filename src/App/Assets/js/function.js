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
        '  <div class="header">' +
        title +
        ' </div>' +
        '       <div class="content">' +
        message +
        '        </div>' +
        '        <div class="actions">' +
        '           <div class="ui negative button">OK</div>' +
        '       </div>' +
        ' </div> ';
    $("body").append(modal);
    $('.ui.modal').modal('show');
}

function popRemove(title, message, acao) {   
    var modal = '<div class="ui modal">' +
        '  <div class="header">' +
        title +
        ' </div>' +
        ' <div class="content">' +
        message +
        '        </div>' +
        '   <div class="actions">' +
        '  <div class="ui green basic ok button"><i class="checkmark icon"></i>Sim</div>' +
        '  <div class="ui red basic cancel button"><i class="remove icon"></i>Não</div>' +
        '   </div>' +
        ' </div> ';
    $("body").append(modal);
    $('.ui.modal')
        .modal({
            onDeny: function (e) {
                $('.ui.modal').modal('hide');
                $(".ui.modal").remove();
                return false;
            },
            onApprove: function () {
                if (typeof (acao) == "function")
                    return acao.call();
            }
        })
        .modal('show', { transition: 'fade' })
}

var SCROLL_TOP

function disableScroll() {
    SCROLL_TOP = $(document).scrollTop()

    $("body").css({
        "position": "fixed",
        "left": "0px",
        "right": "0px",
        "top": `${SCROLL_TOP * -1}px`
    })
}

function enableScroll() {
    $("body").css({
        "position": "",
        "left": "",
        "right": "",
        "top": ""
    })

    $(document).scrollTop(SCROLL_TOP)
}