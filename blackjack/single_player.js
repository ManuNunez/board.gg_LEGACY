class Card {
    constructor(suit, value) {
        this.suit = suit;
        this.value = value;
        this.image = `img/cards/${value}${suit}.png`;
    }
}

class Deck {
    constructor() {
        this.suits = ['H', 'D', 'C', 'S'];
        this.values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        this.cards = [];

        this.suits.forEach(suit => {
            this.values.forEach(value => {
                this.cards.push(new Card(suit, value));
            });
        });
    }

    shuffle() {
        for (let i = this.cards.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
        }
    }

    drawCard() {
        if (this.cards.length === 0) {
            return null;
        }
        return this.cards.pop();
    }
}

class BlackjackGame {
    constructor() {
        this.deck = new Deck();
        this.playerHand = [];
        this.dealerHand = [];
    }

    dealInitialCards() {
        this.deck.shuffle();

        this.playerHand = [this.deck.drawCard(), this.deck.drawCard()];
        this.dealerHand = [this.deck.drawCard(), this.deck.drawCard()]; // Modificado para mostrar ambas cartas

        this.displayPlayerHand();
        this.displayDealerHand();
    }

    calculateHandValue(hand) {
        let sum = 0;
        let numAces = 0; // Para manejar el valor del as (1 u 11)

        hand.forEach(card => {
            if (card.value === 'A') {
                numAces++;
                sum += 11;
            } else if (card.value === 'K' || card.value === 'Q' || card.value === 'J') {
                sum += 10;
            } else {
                sum += parseInt(card.value, 10);
            }
        });

        // Ajusta el valor del as si la suma es mayor a 21
        while (sum > 21 && numAces > 0) {
            sum -= 10;
            numAces--;
        }

        return sum;
    }

    displayPlayerHand() {
        const playerHandElement = document.getElementById('player-hand');
        playerHandElement.innerHTML = '';
        this.playerHand.forEach(card => {
            const cardImage = document.createElement('img');
            cardImage.src = card.image;
            cardImage.alt = `${card.value} de ${card.suit}`;
            cardImage.classList.add('card-image'); // Añade la clase card-image
            playerHandElement.appendChild(cardImage);
        });

        const playerHandValue = this.calculateHandValue(this.playerHand);
        const playerHandValueElement = document.createElement('div');
        playerHandValueElement.textContent = `Valor de la mano: ${playerHandValue}`;
        playerHandElement.appendChild(playerHandValueElement);
    }

    displayDealerHand() {
        const dealerHandElement = document.getElementById('dealer-hand');
        dealerHandElement.innerHTML = '';
        this.dealerHand.forEach(card => {
            const cardImage = document.createElement('img');
            cardImage.src = card.image;
            cardImage.alt = `${card.value} de ${card.suit}`;
            cardImage.classList.add('card-image'); // Añade la clase card-image
            dealerHandElement.appendChild(cardImage);
        });

        const dealerHandValue = this.calculateHandValue(this.dealerHand);
        const dealerHandValueElement = document.createElement('div');
        dealerHandValueElement.textContent = `Valor de la mano del dealer: ${dealerHandValue}`;
        dealerHandElement.appendChild(dealerHandValueElement);
    }

    playerHit() {
        if (this.calculateHandValue(this.playerHand) < 21) {
            this.playerHand.push(this.deck.drawCard());
            this.displayPlayerHand();
        } else {
            // Si la suma de los valores de la mano del jugador es mayor a 21, oculta el botón de "Tomar Carta"
            const hitButton = document.getElementById('hit-button');
            hitButton.disabled = true;
        }
    }

    dealerHit() {
        this.displayDealerHand(); // Muestra las cartas del dealer primero
        while (this.calculateHandValue(this.dealerHand) < 17) {
            this.dealerHand.push(this.deck.drawCard());
            this.displayDealerHand(); // Muestra las cartas del dealer después de cada carta tomada
        }
        this.determineWinner(); // Determina el ganador después de que el dealer complete su mano
    }

    determineWinner() {
        const playerHandValue = this.calculateHandValue(this.playerHand);
        const dealerHandValue = this.calculateHandValue(this.dealerHand);

        if (playerHandValue <= 21 && (playerHandValue > dealerHandValue || dealerHandValue > 21)) {
            this.displayResult("¡Ganaste!");
        } else if (dealerHandValue <= 21) {
            this.displayResult("¡Dealer gana!");
        } else {
            this.displayResult("Es un empate.");
        }
    }

    displayResult(message) {
        alert(message);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const game = new BlackjackGame();

    const dealButton = document.getElementById('deal-button');
    dealButton.addEventListener('click', function () {
        game.dealInitialCards();
        // Habilita el botón de "Tomar Carta" después de repartir las cartas
        const hitButton = document.getElementById('hit-button');
        hitButton.disabled = false;
    });

    const hitButton = document.getElementById('hit-button');
    hitButton.addEventListener('click', function () {
        game.playerHit();
    });

    const standButton = document.getElementById('stand-button');
    standButton.addEventListener('click', function () {
        game.dealerHit();
    });

    // Implementa más interacciones del usuario y actualizaciones del DOM según sea necesario
    // ...
});
