<?php
require_once '../includes/config.php';
$page_title = "Shooting Game";
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

    .shooting-game-wrapper {
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

    .game-canvas-container {
        background: linear-gradient(135deg, #001a4d, #003366);
        border: 3px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    #shootingCanvas {
        display: block;
        width: 100%;
        height: auto;
        cursor: crosshair;
    }

    .game-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
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

    .start-button {
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

    .start-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .start-button:disabled {
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

    .stat-box .stat-label {
        font-size: 0.85rem;
    }

    .stat-box .stat-value {
        font-size: 1.2rem;
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
        .shooting-game-wrapper {
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
    }

    @media (max-width: 576px) {
        .game-area {
            padding: 15px;
        }

        .game-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }
</style>

<div class="game-container">
    <div class="shooting-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🎯 SHOOTING GAME 🎯</h1>

            <div class="game-canvas-container">
                <canvas id="shootingCanvas" width="600" height="400"></canvas>
            </div>

            <div class="game-stats">
                <div class="stat-card">
                    <div class="stat-label">Time Left</div>
                    <div class="stat-value" id="timeLeft">30s</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Hits</div>
                    <div class="stat-value" id="hitCount">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Multiplier</div>
                    <div class="stat-value" id="multiplier">1.00x</div>
                </div>
            </div>
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

            <button class="start-button" id="startBtn" onclick="startGame()">🎯 START GAME 🎯</button>

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
                    <div class="stat-label">Total Games</div>
                    <div class="stat-value" id="totalGames">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set your bet<br>
                2. Click START<br>
                3. Click targets to shoot<br>
                4. Each hit = +0.1x multiplier<br>
                5. Win based on hits!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('shootingCanvas');
const ctx = canvas.getContext('2d');

let gameState = {
    isActive: false,
    bet: 500,
    hits: 0,
    timeLeft: 30,
    targets: [],
    multiplier: 1
};

let totalGames = 0;
let totalWon = 0;
let gameInterval = null;

class Target {
    constructor() {
        this.x = Math.random() * (canvas.width - 40) + 20;
        this.y = Math.random() * (canvas.height - 40) + 20;
        this.radius = 20;
        this.color = `hsl(${Math.random() * 60 + 30}, 100%, 50%)`;
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Draw crosshair
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(this.x - 10, this.y);
        ctx.lineTo(this.x + 10, this.y);
        ctx.moveTo(this.x, this.y - 10);
        ctx.lineTo(this.x, this.y + 10);
        ctx.stroke();
    }

    isHit(x, y) {
        const dx = x - this.x;
        const dy = y - this.y;
        return Math.sqrt(dx * dx + dy * dy) < this.radius;
    }
}

function getBalance() {
    return fetch('../api/get-balance.php')
        .then(r => r.json())
        .then(d => d.balance);
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

function startGame() {
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

        gameState.isActive = true;
        gameState.bet = bet;
        gameState.hits = 0;
        gameState.timeLeft = 30;
        gameState.targets = [];
        gameState.multiplier = 1;

        document.getElementById('startBtn').disabled = true;
        document.getElementById('betAmount').disabled = true;

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        });

        // Create initial targets
        for (let i = 0; i < 5; i++) {
            gameState.targets.push(new Target());
        }

        // Game loop
        gameInterval = setInterval(() => {
            gameState.timeLeft--;
            document.getElementById('timeLeft').textContent = gameState.timeLeft + 's';

            if (gameState.timeLeft <= 0) {
                endGame();
            }
        }, 1000);

        draw();
        showNotification('Game started! Click targets to shoot!', 'info');
    });
}

function endGame() {
    gameState.isActive = false;
    clearInterval(gameInterval);

    const winAmount = gameState.bet * gameState.multiplier;
    totalGames++;
    totalWon += winAmount;

    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({amount: winAmount})
    }).then(r => r.json()).then(d => {
        document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
        document.getElementById('totalGames').textContent = totalGames;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

        showNotification(`Game Over! You hit ${gameState.hits} targets and won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
    });

    document.getElementById('startBtn').disabled = false;
    document.getElementById('betAmount').disabled = false;
}

function draw() {
    ctx.fillStyle = 'rgba(0, 26, 77, 0.5)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw targets
    gameState.targets.forEach(target => target.draw());

    if (gameState.isActive) {
        requestAnimationFrame(draw);
    }
}

canvas.addEventListener('click', (e) => {
    if (!gameState.isActive) return;

    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    for (let i = gameState.targets.length - 1; i >= 0; i--) {
        if (gameState.targets[i].isHit(x, y)) {
            gameState.targets.splice(i, 1);
            gameState.hits++;
            gameState.multiplier = 1 + (gameState.hits * 0.1);

            document.getElementById('hitCount').textContent = gameState.hits;
            document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(2) + 'x';

            // Add new target
            gameState.targets.push(new Target());
            break;
        }
    }
});

// Initialize
getBalance().then(balance => {
    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
draw();
</script>

<?php include '../includes/footer.php'; ?>
