function iniciarSesion(){

    let email = document.getElementById("email").value;
    let contrasena = document.getElementById("contrasena").value;

    fetch("./backend/index.php",{

        method:"POST",

        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },

        body:new URLSearchParams({

            action:"login",

            email:email,

            contrasena:contrasena

        })

    })

    .then(response => response.json())

    .then(data=>{

        if(data){

            window.location.href="perfil.php";

        }else{

            alert("Email o contraseña incorrectos");

        }

    });

}