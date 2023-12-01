class Card {
    constructor(suit, value) {
        this._suit = suit;
        this._value = value;
        this._image = `img/cards/${value}${suit}.png`;
    }

    get suit() {
        return this._suit;
    }

    get value() {
        return this._value;
    }

    get image() {
        return this._image;
    }
}

class NumericCard extends Card {
    constructor(suit, value) {
        super(suit, value);
    }
}

class FaceCard extends Card {
    constructor(suit, value) {
        super(suit, value);
    }

    getPoints() {
        return 10; // Cartas de figuras valen 10 puntos en el blackjack.
    }
}

class Deck {
    constructor() {
        this._suits = ['H', 'D', 'C', 'S'];
        this._values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        this._cards = [];

        this._suits.forEach(suit => {
            this._values.forEach(value => {
                this._cards.push(new Card(suit, value));
            });
        });
    }

    shuffle() {
        for (let i = this._cards.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [this._cards[i], this._cards[j]] = [this._cards[j], this._cards[i]];
        }
    }

    drawCard() {
        if (this._cards.length === 0) {
            return null;
        }
        return this._cards.pop();
    }
}

class BlackjackGame {
    constructor() {
        this._deck = new Deck();
        this._playerHand = [];
        this._dealerHand = [];
    }

    dealInitialCards() {
        this._deck.shuffle();

        this._playerHand = [this._deck.drawCard(), this._deck.drawCard()];
        this._dealerHand = [this._deck.drawCard(), this._deck.drawCard()];

        this._displayPlayerHand();
        this._displayDealerHand();
        this._updateBetDisplay();
    }

    _calculateHandValue(hand) {
        let sum = 0;
        let numAces = 0;

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

        while (sum > 21 && numAces > 0) {
            sum -= 10;
            numAces--;
        }

        return sum;
    }
    _displayPlayerHand() {
        const playerHandElement = document.getElementById('player-hand');
        playerHandElement.innerHTML = '';
        this._playerHand.forEach(card => {
            const cardImage = document.createElement('img');
            cardImage.src = card.image;
            cardImage.alt = `${card.value} de ${card.suit}`;
            cardImage.classList.add('card-image');
            playerHandElement.appendChild(cardImage);
        });

        const playerHandValue = this._calculateHandValue(this._playerHand);
        const playerHandValueElement = document.createElement('div');
        playerHandValueElement.textContent = `Valor de la mano: ${playerHandValue}`;
        playerHandElement.appendChild(playerHandValueElement);
    }

    _displayDealerHand() {
        const dealerHandElement = document.getElementById('dealer-hand');
        dealerHandElement.innerHTML = '';
        this._dealerHand.forEach(card => {
            const cardImage = document.createElement('img');
            cardImage.src = card.image;
            cardImage.alt = `${card.value} de ${card.suit}`;
            cardImage.classList.add('card-image');
            dealerHandElement.appendChild(cardImage);
        });

        const dealerHandValue = this._calculateHandValue(this._dealerHand);
        const dealerHandValueElement = document.createElement('div');
        dealerHandValueElement.textContent = `Valor de la mano del dealer: ${dealerHandValue}`;
        dealerHandElement.appendChild(dealerHandValueElement);
    }

    _updateBetDisplay() {
        const betDisplay = document.getElementById('bet-display');
        const betAmount = parseInt(document.getElementById('bet-input').value, 10);
        betDisplay.textContent = `Apuesta actual: ${betAmount} fichas`;
    }

    _determineWinner() {
        const playerHandValue = this._calculateHandValue(this._playerHand);
        const dealerHandValue = this._calculateHandValue(this._dealerHand);

        if (playerHandValue <= 21 && (playerHandValue > dealerHandValue || dealerHandValue > 21)) {
            this._handleWin();
        } else if (dealerHandValue <= 21) {
            this._handleLoss();
        } else {
            this._handleDraw();
        }
    }

    _handleWin() {
        let betAmount = parseInt(document.getElementById('bet-input').value, 10);
        betAmount *= 2;
        alert(`¡Ganaste! Has ganado ${betAmount} fichas.`);
        this._updateBetDisplay();
    }

    _handleLoss() {
        let betAmount = parseInt(document.getElementById('bet-input').value, 10);
        alert(`¡Dealer gana! Has perdido ${betAmount} fichas.`);
        this._updateBetDisplay();
    }

    _handleDraw() {
        alert(`Es un empate. No pierdes ni ganas fichas.`);
        this._updateBetDisplay();
    }

    playerHit() {
        if (this._calculateHandValue(this._playerHand) < 21) {
            this._playerHand.push(this._deck.drawCard());
            this._displayPlayerHand();
        } else {
            const hitButton = document.getElementById('hit-button');
            hitButton.disabled = true;
        }
    }

    dealerHit() {
        this._displayDealerHand();
        while (this._calculateHandValue(this._dealerHand) < 17) {
            this._dealerHand.push(this._deck.drawCard());
            this._displayDealerHand();
        }
        this._determineWinner();
    }

}

document.addEventListener('DOMContentLoaded', function () {
    const game = new BlackjackGame();

    const dealButton = document.getElementById('deal-button');
    dealButton.addEventListener('click', function () {
        const betAmount = parseInt(document.getElementById('bet-input').value, 10);

        if (isNaN(betAmount) || betAmount < 5) {
            alert("La apuesta mínima es de 5 fichas.");
            return;
        }

        game.dealInitialCards();
        const hitButton = document.getElementById('hit-button');
        const standButton = document.getElementById('stand-button');
        hitButton.disabled = false;
        standButton.disabled = false;
    });

    const hitButton = document.getElementById('hit-button');
    hitButton.addEventListener('click', function () {
        game.playerHit();
    });

    const standButton = document.getElementById('stand-button');
    standButton.addEventListener('click', function () {
        game.dealerHit();
    });
});
