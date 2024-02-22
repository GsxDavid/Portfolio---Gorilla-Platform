"use strict";

let contactForm = document.getElementById("contactForm");
let nombre = document.getElementById("nombre");
let apellidos = document.getElementById("apellidos");
let email = document.getElementById("email");
let mensaje = document.getElementById("mensaje");

contactForm.addEventListener("submit", async function (evt) {
    let res = "";
    if (nombre.value !== ""  && apellidos.value !== "" && email.value !== "" && mensaje.value !== "") {
        evt.preventDefault();
        res = await sendMessage(nombre.value, apellidos.value, email.value, mensaje.value);
        if (res.status === "Message has been send") {
            Swal.fire("Se ha enviado el mensaje", "En breve nos comunicaremos con usted", "success");
            limpiarFormulario();

        }
    } else {
        Swal.fire("Falta información", "Todos los campos son requeridos, por favor intente nuevamente.", "error");
        evt.preventDefault()
    }
})

async function sendMessage(nombre, apellidos, email, mensaje) {
    let frmData = new FormData();
    frmData.append("action", "sendMessage");
    frmData.append("nombre", nombre);
    frmData.append("apellidos", apellidos);
    frmData.append("email", email);
    frmData.append("mensaje", mensaje)

    return await fetch("sendMail.php", {
        method: 'post',
        body: frmData
    })
        .then(data => data.json())
}

function limpiarFormulario() {
    nombre.value = "";
    apellidos.value = "";
    email.value = "";
    mensaje.value = "";
}

