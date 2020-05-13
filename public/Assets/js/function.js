function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var formdata = new FormData();
    $.map(unindexed_array, function (n, i) {
        formdata.append(n['name'], n['value']);
    });
    return formdata;
}

function popCadastro(body) {
    $(".modal").remove();
    $("body").append(body);
    $('.modal').modal('show');
}

function popError(title, message) {
    $(".modal").remove();
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

function creat_popup(title, message, callback) {
  $(".modal").remove();
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
        '<button type="button" class="btn btn-default" id="modal-btn-si">Sim</button>'+
        '<button type="button" class="btn btn-primary" id="modal-btn-no">Não</button>'+
      '</div>'+
    '</div>'+
 '</div>'+
'</div>';
  $("body").append(modal_b);
  $('.modal').modal('show');
  $("#modal-btn-si").on("click", function(){
    callback(true);
    $(".modal").modal('hide');
  });
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $(".modal").modal('hide');
  });
}