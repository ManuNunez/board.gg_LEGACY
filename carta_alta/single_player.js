class Carta {
    constructor(valor, palo) {
        this.valor = valor;
        this.palo = palo;
    }

    obtenerNombreCarta() {
        const nombres = {
            '11': 'J',
            '12': 'Q',
            '13': 'K',
            '15': 'A'
        };
        const nombreValor = nombres[this.valor.toString()] || this.valor.toString();
        return `${nombreValor}${this.palo}.png`;
    }
}

function iniciarJuego() {
    const palos = ['D', 'C', 'H', 'S']; // Diamantes, Corazones, Picas, Tréboles
    const valores = ['2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '15']; // Valores de 1 a 13

    // Escoge una carta aleatoria para el usuario
    const paloUsuario = palos[Math.floor(Math.random() * palos.length)];
    const valorUsuario = valores[Math.floor(Math.random() * valores.length)];
    const cartaUsuario = new Carta(valorUsuario, paloUsuario);
    const nombreCartaUsuario = cartaUsuario.obtenerNombreCarta();
    const rutaImagenUsuario = `img/cards/${nombreCartaUsuario}`;

    // Escoge una carta aleatoria para la casa
    const paloCasa = palos[Math.floor(Math.random() * palos.length)];
    const valorCasa = valores[Math.floor(Math.random() * valores.length)];
    const cartaCasa = new Carta(valorCasa, paloCasa);
    const nombreCartaCasa = cartaCasa.obtenerNombreCarta();
    const rutaImagenCasa = `img/cards/${nombreCartaCasa}`;

    const cartaUsuarioDiv = document.getElementById('carta-usuario');
    const cartaCasaDiv = document.getElementById('carta-casa');

    // Asignar imágenes de las cartas a los contenedores
    cartaUsuarioDiv.innerHTML = `<h3>Carta del Usuario:</h3>
                                 <img src="${rutaImagenUsuario}" alt="Carta del Usuario" class="img-fluid">`;

    cartaCasaDiv.innerHTML = `<h3>Carta de la Casa:</h3>
                               <img src="${rutaImagenCasa}" alt="Carta de la Casa" class="img-fluid">`;

    const resultadoDiv = document.getElementById('resultado');
    resultadoDiv.innerHTML = ''; // Limpiar resultados anteriores

    // Determinar el ganador
    if (parseInt(valorUsuario) > parseInt(valorCasa)) {
        resultadoDiv.innerHTML = "<h2>¡El Usuario gana!</h2>";
    } 
    else
        resultadoDiv.innerHTML = "<h2>¡La Casa gana!</h2>";
    }
