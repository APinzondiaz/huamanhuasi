function mostrarVistaPrevia(input) {
    console.log("Mostrando vista previa");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#vistaPrevia").attr("src", e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Ejecutar la función cuando se cargue la página
window.onload = function () {
    var imagenInput = document.getElementById("imagen");
    imagenInput.addEventListener("change", function () {
        console.log("Evento change activado");
        mostrarVistaPrevia(this);
    });
};
