var etiquetaDiv = document.getElementById("info");

var ajax = new XMLHttpRequest();

function mostrarSugerencia(txtValor) {
    if (txtValor.length === 0) {
        document.getElementById("info").innerHTML = "";
    } else {
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 200) {
                etiquetaDiv.innerHTML = ajax.responseText;
            }
        };
        ajax.open("GET", "servidor.php?nombre=" + txtValor, true);
        ajax.send();
    }
}