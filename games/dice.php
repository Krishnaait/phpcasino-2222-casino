<?php
require_once '../includes/config.php';
$page_title = "Dice Game";
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

    .dice-game-wrapper {
        max-width: 1200px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 400px;
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
        margin-bottom: 30px;
        font-weight: bold;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    .dice-display {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin: 50px 0;
        min-height: 180px;
        align-items: center;
    }

    .dice {
        width: 140px;
        height: 140px;
        background: linear-gradient(145deg, #ffffff, #e0e0e0);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        animation: diceIdle 2s ease-in-out infinite;
        color: #1a0a2e;
        font-weight: bold;
    }

    @keyframes diceIdle {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes diceRoll {
        0% { transform: rotate(0deg) scale(1); }
        25% { transform: rotate(90deg) scale(1.1); }
        50% { transform: rotate(180deg) scale(1); }
        75% { transform: rotate(270deg) scale(1.1); }
        100% { transform: rotate(360deg) scale(1); }
    }

    .dice.rolling {
        animation: diceRoll 0.6s ease-in-out;
    }

    .prediction-section {
        text-align: center;
        margin: 30px 0;
    }

    .prediction-label {
        color: #fff;
        font-size: 1.2rem;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .prediction-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .prediction-btn {
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .prediction-btn:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
        transform: translateY(-2px);
    }

    .prediction-btn.active {
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        border-color: var(--accent-gold);
        color: #1a0a2e;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    .result-display {
        text-align: center;
        margin: 30px 0;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .result-message {
        font-size: 1.8rem;
        font-weight: bold;
        padding: 20px 30px;
        border-radius: var(--radius-lg);
        animation: resultPop 0.5s ease;
    }

    .result-message.win {
        color: var(--accent-green);
        background: rgba(0, 255, 0, 0.1);
        border: 2px solid var(--accent-green);
        text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
    }

    .result-message.lose {
        color: var(--accent-red);
        background: rgba(255, 68, 68, 0.1);
        border: 2px solid var(--accent-red);
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
        margin-bottom: 25px;
    }

    .control-label {
        display: block;
        color: #fff;
        font-size: 1rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .control-input {
        width: 100%;
        padding: 12px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 1rem;
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
        gap: 10px;
        margin-top: 10px;
    }

    .preset-btn {
        padding: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .preset-btn:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
    }

    .roll-button {
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

    .roll-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .roll-button:disabled {
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
        margin-top: 20px;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
    }

    @media (max-width: 968px) {
        .dice-game-wrapper {
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

        .dice {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }
    }

    @media (max-width: 576px) {
        .dice-display {
            gap: 15px;
        }

        .dice {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }

        .prediction-buttons {
            gap: 8px;
        }

        .prediction-btn {
            padding: 10px 16px;
            font-size: 0.85rem;
        }

        .game-area {
            padding: 15px;
        }
    }
</style>

<div class="game-container">
    <div class="dice-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🎲 DICE GAME 🎲</h1>

            <div class="dice-display">
                <div class="dice" id="dice1">?</div>
                <div class="dice" id="dice2">?</div>
            </div>

            <div class="prediction-section">
                <div class="prediction-label">Predict the Total:</div>
                <div class="prediction-buttons">
                    <button class="prediction-btn" data-prediction="under7">Under 7</button>
                    <button class="prediction-btn" data-prediction="7">Exactly 7</button>
                    <button class="prediction-btn" data-prediction="over7">Over 7</button>
                </div>
            </div>

            <div class="result-display" id="resultDisplay"></div>
        </div>

        <div class="control-panel">
            <h2 class="control-title">🎮 Game Controls</h2>

            <div class="control-group">
                <label class="control-label">Bet Amount:</label>
                <input type="number" id="betAmount" class="control-input" min="200" max="5500" value="500" placeholder="Enter bet">
                <div class="bet-presets">
                    <button class="preset-btn" onclick="setBet(200)">200</button>
                    <button class="preset-btn" onclick="setBet(500)">500</button>
                    <button class="preset-btn" onclick="setBet(1000)">1K</button>
                    <button class="preset-btn" onclick="setBet(2000)">2K</button>
                    <button class="preset-btn" onclick="setBet(3500)">3.5K</button>
                </div>
            </div>

            <button class="roll-button" id="rollButton" onclick="rollDice()">🎲 ROLL DICE 🎲</button>

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
                    <div class="stat-label">Total Rolls</div>
                    <div class="stat-value" id="totalRolls">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set your bet amount<br>
                2. Predict if total will be Under 7, Exactly 7, or Over 7<br>
                3. Click ROLL DICE<br>
                4. Win 2x your bet if correct!
            </div>
        </div>
    </div>
</div>

<script>
let selectedPrediction = null;
let isRolling = false;
let totalRolls = 0;
let totalWon = 0;

// Initialize display
getBalance();
updateBetDisplay();

function getBalance() {
    return fetch('../api/get-balance.php')
        .then(r => r.json())
        .then(d => {
            document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            return d.balance;
        });
}

function setBet(amount) {
    if (typeof amount === 'object' && amount.then) {
        // If amount is a Promise (from getBalance)
        amount.then(balance => {
            const bet = Math.min(balance, 5500);
            document.getElementById('betAmount').value = bet;
            updateBetDisplay();
        });
    } else {
        const balance = parseFloat(document.getElementById('balanceDisplay').textContent.replace('₹', '').replace(/,/g, ''));
        const bet = Math.min(amount, balance, 5500);
        document.getElementById('betAmount').value = bet;
        updateBetDisplay();
    }
}

function updateBetDisplay() {
    const bet = parseFloat(document.getElementById('betAmount').value) || 0;
    document.getElementById('betDisplay').textContent = '₹' + bet.toLocaleString('en-IN', {minimumFractionDigits: 2});
}

document.querySelectorAll('.prediction-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.prediction-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedPrediction = this.dataset.prediction;
    });
});

document.getElementById('betAmount').addEventListener('change', updateBetDisplay);
document.getElementById('betAmount').addEventListener('input', updateBetDisplay);

function rollDice() {
    if (isRolling) return;
    if (!selectedPrediction) {
        showNotification('Please select a prediction first!', 'warning');
        return;
    }

    const bet = parseFloat(document.getElementById('betAmount').value);
    const balance = parseFloat(document.getElementById('balanceDisplay').textContent.replace('₹', '').replace(/,/g, ''));

    if (bet < 200 || bet > 5500) {
        showNotification('Bet must be between ₹200 and ₹5,500', 'error');
        return;
    }

    if (bet > balance) {
        showNotification('Insufficient balance!', 'error');
        return;
    }

    isRolling = true;
    document.getElementById('rollButton').disabled = true;
    document.querySelectorAll('.prediction-btn').forEach(b => b.disabled = true);

    const dice1 = document.getElementById('dice1');
    const dice2 = document.getElementById('dice2');

    dice1.classList.add('rolling');
    dice2.classList.add('rolling');

    // Animate spinning numbers
    let spinCount = 0;
    const spinInterval = setInterval(() => {
        dice1.textContent = Math.floor(Math.random() * 6) + 1;
        dice2.textContent = Math.floor(Math.random() * 6) + 1;
        spinCount++;
        if (spinCount >= 15) {
            clearInterval(spinInterval);
        }
    }, 50);

    setTimeout(() => {
        clearInterval(spinInterval);
        const result1 = Math.floor(Math.random() * 6) + 1;
        const result2 = Math.floor(Math.random() * 6) + 1;
        const total = result1 + result2;

        dice1.classList.remove('rolling');
        dice2.classList.remove('rolling');
        dice1.textContent = result1;
        dice2.textContent = result2;

        let won = false;
        if (selectedPrediction === 'under7' && total < 7) won = true;
        if (selectedPrediction === '7' && total === 7) won = true;
        if (selectedPrediction === 'over7' && total > 7) won = true;

        const resultDisplay = document.getElementById('resultDisplay');
        totalRolls++;

        if (won) {
            const winAmount = bet * 2;
            totalWon += winAmount;
            resultDisplay.innerHTML = `<div class="result-message win">✓ YOU WIN! +₹${winAmount.toLocaleString('en-IN')}</div>`;
            
            fetch('../api/update-balance.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({amount: winAmount})
            }).then(r => r.json()).then(d => {
                getBalance();
                showNotification('You won ₹' + winAmount.toLocaleString('en-IN'), 'success');
            });
        } else {
            resultDisplay.innerHTML = `<div class="result-message lose">✗ YOU LOSE! -₹${bet.toLocaleString('en-IN')}</div>`;
            
            fetch('../api/update-balance.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({amount: -bet})
            }).then(r => r.json()).then(d => {
                if (d.zero_balance) {
                    showNotification('Your balance is zero. Click Reset to play again!', 'warning');
                }
                getBalance();
                showNotification('You lost ₹' + bet.toLocaleString('en-IN'), 'error');
            });
        }

        document.getElementById('totalRolls').textContent = totalRolls;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

        isRolling = false;
        document.getElementById('rollButton').disabled = false;
        document.querySelectorAll('.prediction-btn').forEach(b => b.disabled = false);
    }, 600);
}

// Initialize
getBalance();
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
