function guardar_usuario() {

   alert("La función se ejecutó");

    let nombre = document.getElementById("nombre").value;
    console.log("script.js cargado correctamente");
    let apellido = document.getElementById("apellido").value;
    let telefono = document.getElementById("telefono").value;
    let email = document.getElementById("email").value;
    let contrasena = document.getElementById("contrasena").value;

    fetch("backend/index.php?action=agregar_usuario", {

        method: "POST",

        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body: new URLSearchParams({
            action: "agregar_usuario",
            nombre: nombre,
            apellido: apellido,
            telefono: telefono,
            email: email,
            contrasena: contrasena
        })

    })

    .then(response => response.json())

    .then(data => {

        if(data){

            alert("Usuario registrado correctamente");

            mostrar_datos();

        }else{

            alert("Error al registrar el usuario");

        }

    });

}

