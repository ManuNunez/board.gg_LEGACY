<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $phone = $_POST['phone'];
    $birth_date = $_POST['birthdate'];

    $new_user = array(
        "username" => $username,
        "fullname" => $name,
        "pwd" => $pwd,
        "email" => $email,
        "phone" => $phone,
        "birth_date" => $birth_date,
        "acount_tipe" => "3"
    );

    $users = json_decode(file_get_contents('sources/db/users.json'), true);
    $users[$username] = $new_user;

    $users_json = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents('sources/db/users.json', $users_json);

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOARD.GG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="footer.css">
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">BOARD.GG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="games.php">Ver Juegos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pricing.php">Planes</a>
                </li>
                <?php
                if ($isLoggedIn) {
                   
                    echo '<li class="nav-item"><a class="nav-link" href="profile.php">' . $_SESSION['username'] . '</a></li>';
                    echo '<form method="post" class="nav-item"><button type="submit" name="logout" class="btn btn-link nav-link">Logout</button></form>';
                } else {
                    
                    echo '<li class="nav-item"><a class="nav-link" href="login.php">Login/Sign-up</a></li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contactanos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Registro</h2>
        <form method="POST" action="">
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
                <label for="pwd">Contraseña:</label>
                <input type="password" class="form-control" id="pwd" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">INICIA SESION AQUÍ</a></p>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2023 BOARD.GG. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
