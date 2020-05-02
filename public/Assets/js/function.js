function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var formdata = new FormData();
    $.map(unindexed_array, function (n, i) {
        formdata.append(n['name'], n['value']);
    });
    return formdata;
}

function popCadastro(body) {
    $(".ui.modal").remove();
    $("body").append(body);
    $('.ui.modal').modal('show');
}

function popError(title, message) {
    $(".ui.modal").remove();
    var modal_b = '<div class="modal fade" tabindex="-1" role="dialog" id="myModal">'+
    '<div class="modal-dialog" role="document">'+
      '<div class="modal-content">'+
        '<div class="modal-header">'+
          '<h5 class="modal-title">'+title+'</h5>'+
          '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
          '</button>'+
       '</div>'+
        '<div class="modal-body">'+
        message +
        '</div>'+
        '<div class="modal-footer">'+
          '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
        '</div>'+
      '</div>'+
   '</div>'+
  '</div>';
    $("body").append(modal_b);
    $('#myModal').modal('show');
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