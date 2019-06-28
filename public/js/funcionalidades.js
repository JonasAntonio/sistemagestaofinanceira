//Permite a edição no Perfil
$(document).ready(function(){
    $("#btn-editar").click(function () {
        $("input").prop("disabled", false);
        $("#salvar").prop("disabled", false);
        $("#btn-editar").prop("disabled", true);
    });
});

$(document).ready(function(){
  $("#cancelar").click(function () {
      $("input").prop("disabled", true);
      $("#salvar").prop("disabled", true);
      $("#btn-editar").prop("disabled", false);
      $("#perfilModal").modal('hide');
  });
});

$(document).ready(function(){
    //$('.money').mask('000.000.000.00', {reverse: true});
    //$('.date').mask('00/00/0000');
});

//Se passado via url mostra modal-receita
$(document).ready(function() {
    if(window.location.href.indexOf('#modal-receita') != -1) {
      $('#modal-receita').modal('show');
    }
});

//Se passado via url mostra modal-despesa
$(document).ready(function() {
    if(window.location.href.indexOf('#modal-despesa') != -1) {
      $('#modal-despesa').modal('show');
    }
});

//Se passado via url mostra modal-categoria
$(document).ready(function() {
    if(window.location.href.indexOf('#modal-categoria') != -1) {
      $('#modal-categoria').modal('show');
    }
});

//Se passado via url mostra modal-categoria
$(document).ready(function() {
    if(window.location.href.indexOf('#modal-cartao') != -1) {
      $('#modal-cartao').modal('show');
    }
});

//Se passado via url mostra modal-meta
$(document).ready(function() {
    if(window.location.href.indexOf('#modal-meta') != -1) {
      $('#modal-meta').modal('show');
    }
});

// Função script para que alertas sejam retirados das telas
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function () {
        $('#divalert').fadeOut().empty();
    }, 3000);
}, false);
