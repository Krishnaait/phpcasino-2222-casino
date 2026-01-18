<?php
require_once '../includes/config.php';
$page_title = "Mines Game";
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

    .mines-game-wrapper {
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
        margin-bottom: 30px;
        font-weight: bold;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    .game-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 15px;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .stat-value {
        color: var(--accent-gold);
        font-size: 1.5rem;
        font-weight: bold;
    }

    .mines-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin: 30px auto;
        max-width: 500px;
    }

    .mine-tile {
        aspect-ratio: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .mine-tile:hover:not(.revealed):not(.disabled) {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
        transform: scale(1.05);
    }

    .mine-tile.revealed {
        cursor: default;
        animation: tileReveal 0.3s ease;
    }

    .mine-tile.revealed.safe {
        background: linear-gradient(135deg, var(--accent-green), #00cc00);
        border-color: var(--accent-green);
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
    }

    .mine-tile.revealed.mine {
        background: linear-gradient(135deg, var(--accent-red), #cc0000);
        border-color: var(--accent-red);
        box-shadow: 0 0 20px rgba(255, 68, 68, 0.5);
        animation: explode 0.5s ease;
    }

    .mine-tile.disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }

    @keyframes tileReveal {
        0% { transform: rotateY(0deg); }
        50% { transform: rotateY(90deg); }
        100% { transform: rotateY(0deg); }
    }

    @keyframes explode {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.2); }
        50% { transform: scale(0.9); }
        75% { transform: scale(1.1); }
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

    .control-input, .control-select {
        width: 100%;
        padding: 10px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-lg);
        color: #fff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .control-input:focus, .control-select:focus {
        outline: none;
        border-color: var(--accent-gold);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
    }

    .control-select option {
        background: #1a0a2e;
        color: #fff;
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

    .action-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: var(--radius-lg);
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 10px;
    }

    .start-button {
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        color: #1a0a2e;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
    }

    .start-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .cashout-button {
        background: linear-gradient(135deg, var(--accent-green), #00cc00);
        color: #1a0a2e;
        box-shadow: 0 5px 20px rgba(0, 255, 0, 0.4);
    }

    .cashout-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 255, 0, 0.6);
    }

    .action-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
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

    @media (max-width: 968px) {
        .mines-game-wrapper {
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

        .mines-grid {
            gap: 8px;
        }
    }

    @media (max-width: 576px) {
        .mines-grid {
            gap: 6px;
        }

        .mine-tile {
            font-size: 1.5rem;
        }

        .game-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .game-area {
            padding: 15px;
        }
    }
</style>

<div class="game-container">
    <div class="mines-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">💎 MINES 💎</h1>

            <div class="game-stats">
                <div class="stat-card">
                    <div class="stat-label">Multiplier</div>
                    <div class="stat-value" id="multiplierDisplay">1.00x</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Tiles Revealed</div>
                    <div class="stat-value" id="tilesRevealed">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Potential Win</div>
                    <div class="stat-value" id="potentialWin">₹0</div>
                </div>
            </div>

            <div class="mines-grid" id="minesGrid"></div>
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
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Number of Mines:</label>
                <select id="minesCount" class="control-select">
                    <option value="3">3 Mines (Easy)</option>
                    <option value="5" selected>5 Mines (Medium)</option>
                    <option value="7">7 Mines (Hard)</option>
                </select>
            </div>

            <button class="action-button start-button" id="startBtn" onclick="startGame()">🎮 START GAME 🎮</button>
            <button class="action-button cashout-button" id="cashoutBtn" onclick="cashout()" disabled>💰 CASHOUT 💰</button>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set bet & mines<br>
                2. Click START<br>
                3. Reveal safe tiles<br>
                4. Each safe = higher multiplier<br>
                5. Hit mine = lose all<br>
                6. CASHOUT to secure winnings!
            </div>
        </div>
    </div>
</div>

<script>
let gameState = {
    isActive: false,
    bet: 500,
    mines: [],
    revealed: new Set(),
    tilesRevealed: 0,
    multiplier: 1
};

function getBalance() {
    return fetch('../api/get-balance.php')
        .then(r => r.json())
        .then(d => d.balance);
}

function setBet(amount) {
    getBalance().then(balance => {
        const bet = Math.min(amount, balance, 5500);
        document.getElementById('betAmount').value = bet;
        gameState.bet = bet;
    });
}

function startGame() {
    getBalance().then(balance => {
        gameState.bet = parseFloat(document.getElementById('betAmount').value);
        
        if (gameState.bet < 200 || gameState.bet > 5500) {
            showNotification('Bet must be between ₹200 and ₹5,500', 'error');
            return;
        }

        if (gameState.bet > balance) {
            showNotification('Insufficient balance!', 'error');
            return;
        }

        gameState.isActive = true;
        gameState.mines = [];
        gameState.revealed = new Set();
        gameState.tilesRevealed = 0;
        gameState.multiplier = 1;

        const minesCount = parseInt(document.getElementById('minesCount').value);
        while (gameState.mines.length < minesCount) {
            const mine = Math.floor(Math.random() * 25);
            if (!gameState.mines.includes(mine)) {
                gameState.mines.push(mine);
            }
        }

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -gameState.bet})
        });

        document.getElementById('startBtn').disabled = true;
        document.getElementById('cashoutBtn').disabled = false;
        document.querySelectorAll('.mine-tile').forEach(tile => tile.disabled = false);

        showNotification('Game started! Reveal safe tiles to increase multiplier', 'info');
    });
}

function revealTile(index) {
    if (!gameState.isActive || gameState.revealed.has(index)) return;

    gameState.revealed.add(index);
    const tile = document.querySelector(`[data-index="${index}"]`);

    if (gameState.mines.includes(index)) {
        // Hit a mine - game over
        tile.classList.add('revealed', 'mine');
        tile.textContent = '💣';
        gameState.isActive = false;

        // Reveal all mines
        gameState.mines.forEach(mine => {
            const mineTile = document.querySelector(`[data-index="${mine}"]`);
            if (!mineTile.classList.contains('revealed')) {
                mineTile.classList.add('revealed', 'mine');
                mineTile.textContent = '💣';
            }
        });

        document.getElementById('startBtn').disabled = false;
        document.getElementById('cashoutBtn').disabled = true;
        document.querySelectorAll('.mine-tile').forEach(t => t.disabled = true);

        showNotification('Game Over! You hit a mine!', 'error');
    } else {
        // Safe tile
        tile.classList.add('revealed', 'safe');
        tile.textContent = '✓';
        gameState.tilesRevealed++;

        const safeCount = 25 - gameState.mines.length;
        gameState.multiplier = 1 + (gameState.tilesRevealed / safeCount) * 4;

        document.getElementById('tilesRevealed').textContent = gameState.tilesRevealed;
        document.getElementById('multiplierDisplay').textContent = gameState.multiplier.toFixed(2) + 'x';
        document.getElementById('potentialWin').textContent = '₹' + (gameState.bet * gameState.multiplier).toLocaleString('en-IN', {minimumFractionDigits: 2});

        showNotification(`+${gameState.tilesRevealed} tiles! Multiplier: ${gameState.multiplier.toFixed(2)}x`, 'success');
    }
}

function cashout() {
    if (!gameState.isActive) return;

    const winAmount = gameState.bet * gameState.multiplier;
    gameState.isActive = false;

    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({amount: winAmount})
    }).then(r => r.json()).then(d => {
        document.getElementById('startBtn').disabled = false;
        document.getElementById('cashoutBtn').disabled = true;
        document.querySelectorAll('.mine-tile').forEach(t => t.disabled = true);

        showNotification(`Cashed out! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}`, 'success');
    });
}

function initializeGrid() {
    const grid = document.getElementById('minesGrid');
    grid.innerHTML = '';

    for (let i = 0; i < 25; i++) {
        const tile = document.createElement('div');
        tile.className = 'mine-tile';
        tile.dataset.index = i;
        tile.textContent = '?';
        tile.onclick = () => revealTile(i);
        grid.appendChild(tile);
    }
}

// Initialize
initializeGrid();
</script>

<?php include '../includes/footer.php'; ?>
