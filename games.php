<?php
session_start();


$isLoggedIn = isset($_SESSION['username']);


if ($isLoggedIn && isset($_POST['logout'])) {

    $_SESSION = array();


    session_destroy();

  
    header('Location: index.php');
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
            <!-- Tarjeta de Poker -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Poker">
                    <div class="card-body">
                        <h5 class="card-title">Poker</h5>
                        <p class="card-text">Juega al emocionante juego de poker y demuestra tus habilidades.</p>
                        <button class="btn btn-info" id="poker-btn">JUGAR</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Ruleta -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Ruleta">
                    <div class="card-body">
                        <h5 class="card-title">Ruleta</h5>
                        <p class="card-text">Prueba tu suerte en nuestro juego de ruleta y gana grandes premios.</p>
                        <button class="btn btn-info" id="ruleta-btn">JUGAR</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Blackjack -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Blackjack">
                    <div class="card-body">
                        <h5 class="card-title">Blackjack</h5>
                        <p class="card-text">Disfruta del clásico juego de blackjack y compite contra el crupier.</p>
                        <button class="btn btn-info" id="blackjack-btn">JUGAR</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Carta Alta -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Carta Alta">
                    <div class="card-body">
                        <h5 class="card-title">Carta Alta</h5>
                        <p class="card-text">Demuestra tu habilidad con las cartas y gana con la carta más alta.</p>
                        <button class="btn btn-info" id="carta-alta-btn">JUGAR</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Dados -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Dados">
                    <div class="card-body">
                        <h5 class="card-title">Dados</h5>
                        <p class="card-text">Lanza los dados y apuesta por los números para ganar.</p>
                        <button class="btn btn-info" id="dados-btn">JUGAR</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Dominó -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Dominó">
                    <div class="card-body">
                        <h5 class="card-title">Dominó</h5>
                        <p class="card-text">Juega al clásico juego de dominó y demuestra tus habilidades estratégicas.</p>
                        <button class="btn btn-info" id="domino-btn">JUGAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2023 BOARD.GG. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="games.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
