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


    <div class="container my-5">
        <h1>BIENVENIDO A BOARD.GG</h1>
        <br>
        <h3>AQUÍ TIENES LOS JUEGOS MÁS JUGADOS</h3>
        <br>
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/350x150" class="d-block w-100" alt="Card image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>POKER</h5>
                        <p>Juega al emocionante juego de poker y demuestra tus habilidades.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/350x150" class="d-block w-100" alt="Card image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>RULETA</h5>
                        <p>Prueba tu suerte en nuestro juego de ruleta y gana grandes premios.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/sources/img/blackjack.png" class="d-block w-100" alt="Card image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>BLACKJACK</h5>
                        <p>Disfruta del clásico juego de blackjack y compite contra el crupier.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/sources/img/carta_alta.png" class="d-block w-100" alt="Card image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>CARTA ALTA</h5>
                        <p>Demuestra tu habilidad con las cartas y gana con la carta más alta.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br>
        <h3></h3>
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
