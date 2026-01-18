<?php
require_once '../includes/config.php';
$page_title = "Racing Game";
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

    .racing-game-wrapper {
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
        background: linear-gradient(180deg, #87ceeb, #90ee90);
        border: 3px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
    }

    #racingCanvas {
        display: block;
        width: 100%;
        height: auto;
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

    .controls-info {
        background: rgba(0, 255, 0, 0.1);
        border: 1px solid rgba(0, 255, 0, 0.3);
        border-radius: var(--radius-lg);
        padding: 12px;
        margin-top: 10px;
        font-size: 0.85rem;
        color: var(--accent-green);
    }

    @media (max-width: 968px) {
        .racing-game-wrapper {
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
    <div class="racing-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🏎️ RACING GAME 🏎️</h1>

            <div class="game-canvas-container">
                <canvas id="racingCanvas" width="600" height="400"></canvas>
            </div>

            <div class="game-stats">
                <div class="stat-card">
                    <div class="stat-label">Distance</div>
                    <div class="stat-value" id="distance">0%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Speed</div>
                    <div class="stat-value" id="speed">0</div>
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

            <button class="start-button" id="startBtn" onclick="startGame()">🏎️ START RACE 🏎️</button>

            <div class="controls-info">
                <strong>Controls:</strong><br>
                ← → Arrow Keys to Steer<br>
                SPACE to Accelerate
            </div>

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
                    <div class="stat-label">Total Races</div>
                    <div class="stat-value" id="totalRaces">0</div>
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
                3. Steer & accelerate<br>
                4. Reach finish line<br>
                5. Win based on time!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('racingCanvas');
const ctx = canvas.getContext('2d');

let gameState = {
    isActive: false,
    bet: 500,
    carX: canvas.width / 2 - 20,
    carY: canvas.height - 80,
    carWidth: 40,
    carHeight: 50,
    speed: 0,
    maxSpeed: 8,
    acceleration: 0.3,
    friction: 0.95,
    distance: 0,
    maxDistance: 1000,
    multiplier: 1,
    startTime: 0,
    finishTime: 0
};

let totalRaces = 0;
let totalWon = 0;
let gameInterval = null;
let keys = {};

class Obstacle {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.width = 60;
        this.height = 40;
        this.color = '#ff4444';
    }

    draw() {
        ctx.fillStyle = this.color;
        ctx.fillRect(this.x, this.y, this.width, this.height);
        ctx.strokeStyle = '#ff0000';
        ctx.lineWidth = 2;
        ctx.strokeRect(this.x, this.y, this.width, this.height);
    }
}

let obstacles = [];

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
        gameState.distance = 0;
        gameState.multiplier = 1;
        gameState.carX = canvas.width / 2 - 20;
        gameState.carY = canvas.height - 80;
        gameState.speed = 0;
        gameState.startTime = Date.now();
        gameState.finishTime = 0;

        obstacles = [];
        for (let i = 0; i < 8; i++) {
            obstacles.push(new Obstacle(
                Math.random() * (canvas.width - 60),
                -i * 150 - 100
            ));
        }

        document.getElementById('startBtn').disabled = true;
        document.getElementById('betAmount').disabled = true;

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        });

        gameInterval = setInterval(updateGame, 1000 / 60);
        draw();
        showNotification('Race started! Steer and accelerate!', 'info');
    });
}

function updateGame() {
    if (!gameState.isActive) return;

    // Handle input
    if (keys['ArrowLeft']) {
        gameState.carX = Math.max(0, gameState.carX - 5);
    }
    if (keys['ArrowRight']) {
        gameState.carX = Math.min(canvas.width - gameState.carWidth, gameState.carX + 5);
    }
    if (keys[' ']) {
        gameState.speed = Math.min(gameState.speed + gameState.acceleration, gameState.maxSpeed);
    }

    gameState.speed *= gameState.friction;
    gameState.distance += gameState.speed;

    // Update obstacles
    obstacles.forEach(obs => {
        obs.y += gameState.speed;
    });

    // Check collisions
    obstacles.forEach(obs => {
        if (gameState.carX < obs.x + obs.width &&
            gameState.carX + gameState.carWidth > obs.x &&
            gameState.carY < obs.y + obs.height &&
            gameState.carY + gameState.carHeight > obs.y) {
            endGame(false);
        }
    });

    // Remove off-screen obstacles and add new ones
    obstacles = obstacles.filter(obs => obs.y < canvas.height);
    if (obstacles.length < 8) {
        obstacles.push(new Obstacle(
            Math.random() * (canvas.width - 60),
            -100
        ));
    }

    // Check finish
    if (gameState.distance >= gameState.maxDistance) {
        gameState.finishTime = Date.now() - gameState.startTime;
        gameState.multiplier = Math.max(1, 5 - (gameState.finishTime / 10000));
        endGame(true);
    }

    // Update display
    document.getElementById('distance').textContent = Math.min(100, Math.floor((gameState.distance / gameState.maxDistance) * 100)) + '%';
    document.getElementById('speed').textContent = Math.floor(gameState.speed * 10);
    document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(2) + 'x';
}

function endGame(won) {
    gameState.isActive = false;
    clearInterval(gameInterval);

    const winAmount = gameState.bet * gameState.multiplier;
    totalRaces++;
    totalWon += winAmount;

    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({amount: winAmount})
    }).then(r => r.json()).then(d => {
        document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
        document.getElementById('totalRaces').textContent = totalRaces;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

        if (won) {
            showNotification(`Race Complete! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
        } else {
            showNotification('Crashed! Game Over!', 'error');
        }
    });

    document.getElementById('startBtn').disabled = false;
    document.getElementById('betAmount').disabled = false;
}

function draw() {
    // Sky
    ctx.fillStyle = '#87ceeb';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Road
    ctx.fillStyle = '#444';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Road lines
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.setLineDash([20, 20]);
    ctx.beginPath();
    ctx.moveTo(canvas.width / 2, 0);
    ctx.lineTo(canvas.width / 2, canvas.height);
    ctx.stroke();
    ctx.setLineDash([]);

    // Draw obstacles
    obstacles.forEach(obs => obs.draw());

    // Draw car
    ctx.fillStyle = '#ff6b35';
    ctx.fillRect(gameState.carX, gameState.carY, gameState.carWidth, gameState.carHeight);
    ctx.fillStyle = '#00d9ff';
    ctx.fillRect(gameState.carX + 5, gameState.carY + 5, gameState.carWidth - 10, 15);

    if (gameState.isActive) {
        requestAnimationFrame(draw);
    }
}

// Keyboard events
document.addEventListener('keydown', (e) => {
    keys[e.key] = true;
});

document.addEventListener('keyup', (e) => {
    keys[e.key] = false;
});

// Initialize
getBalance().then(balance => {
    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
draw();
</script>

<?php include '../includes/footer.php'; ?>
