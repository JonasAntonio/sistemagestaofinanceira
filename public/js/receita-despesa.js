
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