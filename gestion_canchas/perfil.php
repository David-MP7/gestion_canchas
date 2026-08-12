<?php

session_start();

require_once "backend/config/database.php";

if (!isset($_SESSION["id"])) {

    header("Location: login.html");

    exit;

}

$conn = conectar();

$id_usuario = $_SESSION["id"];

// Buscar el perfil del usuario

$sql = "SELECT * FROM perfil_usuario WHERE id_usuario = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id_usuario);

$stmt->execute();

$resultado = $stmt->get_result();

$perfil = $resultado->fetch_assoc();

$stmt->close();

$conn->close();

?>

<!DOCTYPE html>

<html lang="es">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mi Perfil | Reserva de Canchas</title>

<!-- Bootstrap -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet">

<!-- Bootstrap Icons -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <link  rel="stylesheet" href="./assets/css/perfil.css">


</head>

<body>

<!-- ==============================
     NAVBAR
============================== -->

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top shadow-sm">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="index.html">

            <img
                src="assets/img/logo.png"
                width="50"
                height="50"
                class="logo-navbar"
                alt="Logo Reserva Canchas"
            >

            <div class="brand-text">
                <span class="brand-title">Reserva</span>
                <span class="brand-subtitle">Canchas</span>
            </div>

        </a>


        <!-- BOTÓN MÓVIL -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Abrir menú">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENÚ -->

        <div
            class="collapse navbar-collapse"
            id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">


                <!-- CANCHAS -->

                <li class="nav-item">

                    <a class="nav-link active" href="canchas.php">

                        <i class="bi bi-grid-3x3-gap-fill"></i>

                        <span>Canchas</span>

                    </a>

                </li>


                <!-- RESERVAS -->

                <li class="nav-item">

                    <a class="nav-link" href="mis_reservas.php">

                        <i class="bi bi-calendar-check"></i>

                        <span>Mis reservas</span>

                    </a>

                </li>


                <!-- CARRITO -->

                <li class="nav-item">

                    <a class="nav-link carrito-link" href="carrito.php">

                        <span class="carrito-icon">

                            <i class="bi bi-cart3"></i>

                            <span class="carrito-badge">0</span>

                        </span>

                        <span>Carrito</span>

                    </a>

                </li>


                <!-- SEPARADOR -->

                <li class="nav-divider"></li>


                <!-- USUARIO -->

                <li class="nav-item dropdown">

                    <a
                        class="nav-link usuario-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <span class="usuario-icon">

                            <i class="bi bi-person-fill"></i>

                        </span>

                        <span>Mi cuenta</span>

                    </a>


                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>

                            <a class="dropdown-item" href="perfil.php">

                                <i class="bi bi-person me-2"></i>

                                Mi perfil

                            </a>

                        </li>


                        <li>

                            <a class="dropdown-item" href="mis_reservas.php">

                                <i class="bi bi-calendar-check me-2"></i>

                                Mis reservas

                            </a>

                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>

                            <a class="dropdown-item logout-item" href="logout.php">

                                <i class="bi bi-box-arrow-right me-2"></i>

                                Cerrar sesión

                            </a>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- ==============================
     CONTENIDO
============================== -->

<main class="perfil-container">


<div class="perfil-card">


    <!-- ==============================
         INFORMACION PRINCIPAL
    ============================== -->

    <div class="perfil-header">

        <?php if (!empty($perfil["foto"])) { ?>

            <img
                src="<?php echo htmlspecialchars($perfil["foto"]); ?>"
                class="foto-perfil"
                alt="Foto de perfil">

        <?php } else { ?>

            <img
                src="https://via.placeholder.com/120"
                class="foto-perfil"
                alt="Foto de perfil">

        <?php } ?>


        <div>

            <h2 class="nombre-usuario">

                <?php
                echo htmlspecialchars(
                    $perfil["nombre_completo"] ?? "Usuario"
                );
                ?>

            </h2>

            <p class="profesion">

                <?php
                echo htmlspecialchars(
                    $perfil["profesion"] ?? "Usuario registrado"
                );
                ?>

            </p>

            <a
                href="editar_perfil.php"
                class="btn btn-outline-success btn-sm">

                <i class="bi bi-pencil"></i>
                Editar perfil

            </a>

        </div>

    </div>


    <!-- ==============================
         INFORMACION DE CONTACTO
    ============================== -->

    <section class="seccion">

        <h3 class="titulo-seccion">
            <i class="bi bi-person-lines-fill"></i>
            Información de contacto
        </h3>


        <div class="row">

            <div class="col-md-6">

                <div class="info-item">

                    <i class="bi bi-envelope"></i>

                    <div>

                        <div class="info-label">
                            Correo electrónico
                        </div>

                        <p>
                            <?php
                            echo htmlspecialchars(
                                $_SESSION["correo"] ?? "No disponible"
                            );
                            ?>
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="info-item">

                    <i class="bi bi-telephone"></i>

                    <div>

                        <div class="info-label">
                            Teléfono
                        </div>

                        <p>

                            <?php
                            echo htmlspecialchars(
                                $perfil["telefono"] ?? "No disponible"
                            );
                            ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ==============================
         TIEMPO REGISTRADO
    ============================== -->

    <section class="seccion">

        <h3 class="titulo-seccion">
            <i class="bi bi-clock-history"></i>
            Información de la cuenta
        </h3>

        <div class="info-item">

            <i class="bi bi-calendar-plus"></i>

            <div>

                <div class="info-label">
                    Usuario registrado desde
                </div>

                <p>

                    <?php
                    if (!empty($perfil["fecha_registro"])) {

                        echo date(
                            "d/m/Y",
                            strtotime($perfil["fecha_registro"])
                        );

                    } else {

                        echo "Fecha no disponible";

                    }
                    ?>

                </p>

            </div>

        </div>

    </section>


    <!-- ==============================
         RESERVAS
    ============================== -->

    <section class="seccion">

        <h3 class="titulo-seccion">

            <i class="bi bi-calendar-check"></i>

            Mis reservas

        </h3>


        <div class="row g-4">


            <?php if (!empty($reservas)) { ?>


                <?php foreach ($reservas as $reserva) { ?>

                    <div class="col-md-6 col-lg-4">

                        <div class="card reserva-card">

                            <div class="reserva-header">

                                <h5>

                                    <?php
                                    echo htmlspecialchars(
                                        $reserva["cancha"]
                                    );
                                    ?>

                                </h5>

                            </div>


                            <div class="reserva-body">

                                <div class="reserva-info">

                                    <i class="bi bi-calendar"></i>

                                    <?php
                                    echo htmlspecialchars(
                                        $reserva["fecha"]
                                    );
                                    ?>

                                </div>


                                <div class="reserva-info">

                                    <i class="bi bi-clock"></i>

                                    <?php
                                    echo htmlspecialchars(
                                        $reserva["hora"]
                                    );
                                    ?>

                                </div>


                                <div class="reserva-info">

                                    <i class="bi bi-geo-alt"></i>

                                    <?php
                                    echo htmlspecialchars(
                                        $reserva["ubicacion"]
                                    );
                                    ?>

                                </div>


                                <span class="estado">
                                    Reservada
                                </span>

                            </div>

                        </div>

                    </div>

                <?php } ?>


            <?php } else { ?>


                <div class="col-12">

                    <div class="sin-reservas">

                        <i class="bi bi-calendar-x"></i>

                        <h5 class="mt-3">
                            Todavía no tenés reservas
                        </h5>

                        <p class="text-muted">
                            Buscá una cancha y realizá tu primera reserva.
                        </p>

                        <a
                            href="canchas.php"
                            class="btn btn-success">

                            <i class="bi bi-search"></i>
                            Buscar canchas

                        </a>

                    </div>

                </div>


            <?php } ?>

        </div>

    </section>


</div>
```

</main>

<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>
