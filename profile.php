<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header('Location: login.php');
    exit();
}

$usersData = file_get_contents('sources/bd/users.json');
$usersArray = json_decode($usersData, true);

$currentUsername = $_SESSION['username'];
$currentUserData = $usersArray[$currentUsername];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_profile'])) {
    $currentUserData['fullname'] = $_POST['fullname'];
    $currentUserData['email'] = $_POST['email'];
    $currentUserData['phone'] = $_POST['phone'];

    if ($currentUserData['acount_tipe'] == 0) {
        $currentUserData['chips'] = $_POST['chips'];
    }

    $usersArray[$currentUsername] = $currentUserData;
    file_put_contents('sources/bd/users.json', json_encode($usersArray, JSON_PRETTY_PRINT));

    header('Location: profile.php');
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
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <!-- Formulario de edición del perfil -->
                <h2 class="mb-4">Perfil de <?php echo $currentUsername; ?></h2>
                <form method="post">
                    <div class="form-group">
                        <label for="fullname">Nombre completo:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $currentUserData['fullname']; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="email">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $currentUserData['email']; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $currentUserData['phone']; ?>" >
                    </div>
                    
                    <?php if ($currentUserData['acount_tipe'] == 0): ?>
                        <div class="form-group">
                            <label for="chips">Cantidad de monedas:</label>
                            <input type="number" class="form-control" id="chips" name="chips" value="<?php echo $currentUserData['chips']; ?>" >
                        </div>
                    <?php endif; ?>
                    
                    <button type="submit" name="edit_profile" class="btn btn-primary">Editar Perfil</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2023 BOARD.GG. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
