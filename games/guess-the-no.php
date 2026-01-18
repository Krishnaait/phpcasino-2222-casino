<?php
require_once '../includes/config.php';
$page_title = "Guess the Number";
include '../includes/header.php';
?>

<style>
    .game-container {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .guess-game-wrapper {
        max-width: 1200px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 30px;
        align-items: start;
    }

    .game-area {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-2xl);
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .game-title {
        font-size: 2.5rem;
        color: var(--accent-gold);
        text-align: center;
        margin-bottom: 40px;
        font-weight: bold;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    .number-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin: 40px 0;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .number-btn {
        aspect-ratio: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: var(--accent-gold);
        font-size: 2.5rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .number-btn:hover:not(:disabled) {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .number-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .number-btn.selected {
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        border-color: var(--accent-gold);
        color: #1a0a2e;
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
    }

    .result-display {
        text-align: center;
        margin: 40px 0;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .result-message {
        font-size: 2rem;
        font-weight: bold;
        padding: 30px;
        border-radius: var(--radius-lg);
        animation: resultPop 0.5s ease;
        max-width: 400px;
    }

    .result-message.win {
        color: var(--accent-green);
        background: rgba(0, 255, 0, 0.1);
        border: 3px solid var(--accent-green);
        text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
    }

    .result-message.lose {
        color: var(--accent-red);
        background: rgba(255, 68, 68, 0.1);
        border: 3px solid var(--accent-red);
        text-shadow: 0 0 10px rgba(255, 68, 68, 0.5);
    }

    @keyframes resultPop {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .control-panel {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-2xl);
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 100px;
    }

    .control-title {
        font-size: 1.5rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
        font-weight: bold;
    }

    .control-group {
        margin-bottom: 20px;
    }

    .control-label {
        display: block;
        color: #fff;
        font-size: 0.95rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .control-input {
        width: 100%;
        padding: 10px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .control-input:focus {
        outline: none;
        border-color: var(--accent-gold);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
    }

    .bet-presets {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 8px;
    }

    .preset-btn {
        padding: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .preset-btn:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
    }

    .play-button {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        border: none;
        border-radius: var(--radius-lg);
        color: #1a0a2e;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
        margin-top: 20px;
    }

    .play-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .play-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
    }

    .stat-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 15px;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .stat-value {
        color: var(--accent-gold);
        font-size: 1.3rem;
        font-weight: bold;
    }

    .info-box {
        background: rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: var(--radius-lg);
        padding: 15px;
        margin-top: 15px;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .multiplier-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        color: #1a0a2e;
        padding: 8px 16px;
        border-radius: var(--radius-lg);
        font-weight: 700;
        margin-top: 10px;
        font-size: 1.2rem;
    }

    @media (max-width: 968px) {
        .guess-game-wrapper {
            grid-template-columns: 1fr;
        }

        .control-panel {
            position: relative;
            top: 0;
        }

        .game-area {
            padding: 25px;
        }

        .game-title {
            font-size: 1.8rem;
        }

        .number-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 576px) {
        .number-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .number-btn {
            font-size: 2rem;
        }

        .game-area {
            padding: 15px;
        }

        .result-message {
            font-size: 1.5rem;
            padding: 20px;
        }
    }
</style>

<div class="game-container">
    <div class="guess-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🔮 GUESS THE NUMBER 🔮</h1>

            <div class="number-grid">
                <button class="number-btn" onclick="selectNumber(1)">1</button>
                <button class="number-btn" onclick="selectNumber(2)">2</button>
                <button class="number-btn" onclick="selectNumber(3)">3</button>
                <button class="number-btn" onclick="selectNumber(4)">4</button>
                <button class="number-btn" onclick="selectNumber(5)">5</button>
                <button class="number-btn" onclick="selectNumber(6)">6</button>
                <button class="number-btn" onclick="selectNumber(7)">7</button>
            </div>

            <div class="result-display" id="resultDisplay"></div>
        </div>

        <div class="control-panel">
            <h2 class="control-title">🎮 Game Controls</h2>

            <div class="control-group">
                <label class="control-label">Bet Amount:</label>
                <input type="number" id="betAmount" class="control-input" min="200" max="5500" value="500">
                <div class="bet-presets">
                    <button class="preset-btn" onclick="setBet(200)">200</button>
                    <button class="preset-btn" onclick="setBet(500)">500</button>
                    <button class="preset-btn" onclick="setBet(1000)">1K</button>
                    <button class="preset-btn" onclick="setBet(2000)">2K</button>
                    <button class="preset-btn" onclick="setBet(3500)">3.5K</button>
                    <button class="preset-btn" onclick="setBet(getBalance())">MAX</button>
                </div>
            </div>

            <button class="play-button" id="playButton" onclick="playGame()">🎯 PLAY NOW 🎯</button>

            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-label">Your Balance</div>
                    <div class="stat-value" id="balanceDisplay">₹0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Current Bet</div>
                    <div class="stat-value" id="betDisplay">₹0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Plays</div>
                    <div class="stat-value" id="totalPlays">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set your bet<br>
                2. Pick a number (1-7)<br>
                3. Click PLAY NOW<br>
                4. Guess correctly = 7x WIN!<br>
                <div class="multiplier-badge">7x MULTIPLIER</div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedNumber = null;
let isPlaying = false;
let totalPlays = 0;
let totalWon = 0;

function getBalance() {
    return fetch('../api/get-balance.php')
        .then(r => r.json())
        .then(d => d.balance);
}

function selectNumber(num) {
    if (isPlaying) return;
    
    document.querySelectorAll('.number-btn').forEach(btn => btn.classList.remove('selected'));
    event.target.classList.add('selected');
    selectedNumber = num;
}

function setBet(amount) {
    getBalance().then(balance => {
        const bet = Math.min(amount, balance, 5500);
        document.getElementById('betAmount').value = bet;
        updateBetDisplay();
    });
}

function updateBetDisplay() {
    const bet = parseFloat(document.getElementById('betAmount').value) || 0;
    document.getElementById('betDisplay').textContent = '₹' + bet.toLocaleString('en-IN', {minimumFractionDigits: 2});
}

function playGame() {
    if (isPlaying) return;
    if (selectedNumber === null) {
        showNotification('Please select a number first!', 'warning');
        return;
    }

    const bet = parseFloat(document.getElementById('betAmount').value);
    
    getBalance().then(balance => {
        if (bet < 200 || bet > 5500) {
            showNotification('Bet must be between ₹200 and ₹5,500', 'error');
            return;
        }

        if (bet > balance) {
            showNotification('Insufficient balance!', 'error');
            return;
        }

        isPlaying = true;
        document.getElementById('playButton').disabled = true;
        document.querySelectorAll('.number-btn').forEach(btn => btn.disabled = true);

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        });

        // Simulate thinking
        setTimeout(() => {
            const winningNumber = Math.floor(Math.random() * 7) + 1;
            const won = selectedNumber === winningNumber;

            totalPlays++;

            if (won) {
                const winAmount = bet * 7;
                totalWon += winAmount;

                fetch('../api/update-balance.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({amount: winAmount})
                }).then(r => r.json()).then(d => {
                    document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
                    document.getElementById('totalPlays').textContent = totalPlays;
                    document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

                    document.getElementById('resultDisplay').innerHTML = `<div class="result-message win">✓ CORRECT! Number was ${winningNumber}<br>YOU WIN 7x! +₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}</div>`;
                    showNotification(`You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
                });
            } else {
                document.getElementById('totalPlays').textContent = totalPlays;
                document.getElementById('resultDisplay').innerHTML = `<div class="result-message lose">✗ WRONG! Number was ${winningNumber}<br>YOU LOST -₹${bet.toLocaleString('en-IN', {minimumFractionDigits: 2})}</div>`;
                showNotification(`You lost ₹${bet.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'error');

                getBalance().then(balance => {
                    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
                    if (balance <= 0) {
                        showNotification('Your balance is zero. Click Reset to play again!', 'warning');
                    }
                });
            }

            isPlaying = false;
            document.getElementById('playButton').disabled = false;
            document.querySelectorAll('.number-btn').forEach(btn => btn.disabled = false);
        }, 1500);
    });
}

// Initialize
getBalance().then(balance => {
    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
