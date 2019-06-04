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

// Função script para que alertas sejam retirados das telas
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function () {
        $('#divalert').fadeOut().empty();
    }, 3000);
}, false);

//Função script para que checkbox hidden seja desabilitado se o visivel estiver checked
if(document.getElementById("categoriasCheck").checked) {
    document.getElementById('categoriasCheckHidden').disabled = true;
}

//Funções scripts para os checkboxs hidden de receitas sejam desabilitados se o visivel estiver checked
if(document.getElementById("disponivelCheck").checked) {
    document.getElementById('disponivelCheckHidden').disabled = true;
}
if(document.getElementById("fixaCheck").checked) {
    document.getElementById('fixaCheckHidden').disabled = true;
}
if(document.getElementById("recorrenteCheck").checked) {
    document.getElementById('recorrenteCheckHidden').disabled = true;
}

//Funções scripts para os checkboxs hidden de despesas sejam desabilitados se o visivel estiver checked
if(document.getElementById("pagoCheck").checked) {
    document.getElementById('pagoCheckHidden').disabled = true;
}
if(document.getElementById("parceladoCheck").checked) {
    document.getElementById('parceladoCheckHidden').disabled = true;
}
if(document.getElementById("recorrenteCheck").checked) {
    document.getElementById('recorrenteCheckHidden').disabled = true;
}