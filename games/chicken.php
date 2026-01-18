<?php
require_once '../includes/config.php';
$page_title = "Chicken Game";
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

    .chicken-game-wrapper {
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

    #chickenCanvas {
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
        .chicken-game-wrapper {
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
    <div class="chicken-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🐔 CHICKEN GAME 🐔</h1>

            <div class="game-canvas-container">
                <canvas id="chickenCanvas" width="600" height="300"></canvas>
            </div>

            <div class="game-stats">
                <div class="stat-card">
                    <div class="stat-label">Distance</div>
                    <div class="stat-value" id="distance">0m</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Eggs</div>
                    <div class="stat-value" id="eggs">0</div>
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
                </div>
            </div>

            <button class="action-button start-button" id="startBtn" onclick="startGame()">🐔 START GAME 🐔</button>
            <button class="action-button cashout-button" id="cashoutBtn" onclick="cashout()" disabled>💰 CASHOUT 💰</button>

            <div class="controls-info">
                <strong>Controls:</strong><br>
                ← → Arrow Keys to Move<br>
                SPACE to Jump
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
                3. Navigate the chicken<br>
                4. Collect eggs for bonus<br>
                5. Avoid obstacles<br>
                6. CASHOUT to secure win!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('chickenCanvas');
const ctx = canvas.getContext('2d');

let gameState = {
    isActive: false,
    bet: 500,
    chickenX: 50,
    chickenY: canvas.height - 60,
    chickenWidth: 30,
    chickenHeight: 30,
    velocityY: 0,
    gravity: 0.6,
    jumpPower: 12,
    isJumping: false,
    distance: 0,
    eggs: 0,
    multiplier: 1,
    obstacles: [],
    bonuses: []
};

let totalGames = 0;
let totalWon = 0;
let gameInterval = null;
let keys = {};

class Obstacle {
    constructor(x) {
        this.x = x;
        this.y = canvas.height - 50;
        this.width = 30;
        this.height = 50;
    }

    draw() {
        ctx.fillStyle = '#ff4444';
        ctx.fillRect(this.x, this.y, this.width, this.height);
        ctx.strokeStyle = '#ff0000';
        ctx.lineWidth = 2;
        ctx.strokeRect(this.x, this.y, this.width, this.height);
    }
}

class Bonus {
    constructor(x) {
        this.x = x;
        this.y = canvas.height - 100;
        this.radius = 12;
        this.collected = false;
    }

    draw() {
        ctx.fillStyle = '#ffd700';
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = '#ffed4e';
        ctx.lineWidth = 2;
        ctx.stroke();
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
        gameState.chickenX = 50;
        gameState.chickenY = canvas.height - 60;
        gameState.velocityY = 0;
        gameState.distance = 0;
        gameState.eggs = 0;
        gameState.multiplier = 1;
        gameState.obstacles = [];
        gameState.bonuses = [];

        document.getElementById('startBtn').disabled = true;
        document.getElementById('cashoutBtn').disabled = false;

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        });

        gameInterval = setInterval(updateGame, 1000 / 60);
        draw();
        showNotification('Game started! Navigate the chicken!', 'info');
    });
}

function updateGame() {
    if (!gameState.isActive) return;

    // Handle input
    if (keys['ArrowLeft']) {
        gameState.chickenX = Math.max(0, gameState.chickenX - 5);
    }
    if (keys['ArrowRight']) {
        gameState.chickenX = Math.min(canvas.width - gameState.chickenWidth, gameState.chickenX + 5);
    }
    if (keys[' '] && !gameState.isJumping) {
        gameState.velocityY = -gameState.jumpPower;
        gameState.isJumping = true;
    }

    // Apply gravity
    gameState.velocityY += gameState.gravity;
    gameState.chickenY += gameState.velocityY;

    // Ground collision
    if (gameState.chickenY >= canvas.height - 60) {
        gameState.chickenY = canvas.height - 60;
        gameState.velocityY = 0;
        gameState.isJumping = false;
    }

    // Update distance
    gameState.distance += 2;

    // Spawn obstacles
    if (gameState.distance % 100 === 0 && Math.random() > 0.5) {
        gameState.obstacles.push(new Obstacle(canvas.width));
    }

    // Spawn bonuses
    if (gameState.distance % 150 === 0 && Math.random() > 0.7) {
        gameState.bonuses.push(new Bonus(canvas.width));
    }

    // Update obstacles
    gameState.obstacles = gameState.obstacles.filter(obs => {
        obs.x -= 5;

        // Check collision
        if (gameState.chickenX < obs.x + obs.width &&
            gameState.chickenX + gameState.chickenWidth > obs.x &&
            gameState.chickenY < obs.y + obs.height &&
            gameState.chickenY + gameState.chickenHeight > obs.y) {
            endGame();
            return false;
        }

        return obs.x > -obs.width;
    });

    // Update bonuses
    gameState.bonuses = gameState.bonuses.filter(bonus => {
        bonus.x -= 5;

        if (!bonus.collected &&
            gameState.chickenX < bonus.x + bonus.radius &&
            gameState.chickenX + gameState.chickenWidth > bonus.x - bonus.radius &&
            gameState.chickenY < bonus.y + bonus.radius &&
            gameState.chickenY + gameState.chickenHeight > bonus.y - bonus.radius) {
            bonus.collected = true;
            gameState.eggs++;
            gameState.multiplier = 1 + (gameState.distance / 500) + (gameState.eggs * 0.2);
            showNotification('Egg collected! +0.2x multiplier', 'success');
        }

        return bonus.x > -bonus.radius * 2;
    });

    // Update display
    document.getElementById('distance').textContent = Math.floor(gameState.distance) + 'm';
    document.getElementById('eggs').textContent = gameState.eggs;
    document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(2) + 'x';
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

        showNotification(`Game Over! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
    });

    document.getElementById('startBtn').disabled = false;
    document.getElementById('cashoutBtn').disabled = true;
}

function cashout() {
    if (!gameState.isActive) return;

    const winAmount = gameState.bet * gameState.multiplier;
    gameState.isActive = false;
    clearInterval(gameInterval);

    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({amount: winAmount})
    }).then(r => r.json()).then(d => {
        totalGames++;
        totalWon += winAmount;
        document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
        document.getElementById('totalGames').textContent = totalGames;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

        showNotification(`Cashed out! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
    });

    document.getElementById('startBtn').disabled = false;
    document.getElementById('cashoutBtn').disabled = true;
}

function draw() {
    // Sky
    ctx.fillStyle = '#87ceeb';
    ctx.fillRect(0, 0, canvas.width, canvas.height / 2);

    // Ground
    ctx.fillStyle = '#90ee90';
    ctx.fillRect(0, canvas.height / 2, canvas.width, canvas.height / 2);

    // Draw chicken
    ctx.fillStyle = '#ff9900';
    ctx.fillRect(gameState.chickenX, gameState.chickenY, gameState.chickenWidth, gameState.chickenHeight);
    ctx.fillStyle = '#000';
    ctx.beginPath();
    ctx.arc(gameState.chickenX + 8, gameState.chickenY + 8, 3, 0, Math.PI * 2);
    ctx.fill();

    // Draw obstacles
    gameState.obstacles.forEach(obs => obs.draw());

    // Draw bonuses
    gameState.bonuses.forEach(bonus => bonus.draw());

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
