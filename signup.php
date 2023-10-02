<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $birthdate = $_POST['birthdate'];

    if ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    $usersFile = 'sources/db/users.json';

    $users = json_decode(file_get_contents($usersFile), true);

    if (isset($users[$username])) {
        echo "El nombre de usuario ya está en uso.";
        exit();
    }

    $new_user = array(
        "fullname" => $fullname,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "birthdate" => $birthdate,
        "fichas" => 5000
    );

    $users[$username] = $new_user;

    $users_json = json_encode($users, JSON_PRETTY_PRINT);

    file_put_contents($usersFile, $users_json);

    header('Location: login.html?success=1');
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/flatly/bootstrap.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.html">BOARD.GG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="games.html">Ver Juegos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pricing.html">Planes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.html">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Login/Sign-up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contactanos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Registro</h2>
        <form method="POST"action = "new_user.php">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="fullname">Nombre Completo:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <p>ya tienes cuenta? <a href="login.html">INICIA SESION AQUÍ</a></p>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
