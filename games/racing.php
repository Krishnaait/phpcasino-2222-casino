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
        background: linear-gradient(180deg, #1a1a2e, #16213e);
        border: 3px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        position: relative;
    }

    #racingCanvas {
        display: block;
        width: 100%;
        height: auto;
    }

    .game-stats-bar {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-item {
        background: rgba(0, 0, 0, 0.3);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 15px;
        text-align: center;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--gray-text);
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-gold);
    }

    .controls-panel {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-2xl);
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .controls-title {
        font-size: 1.5rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bet-controls {
        margin-bottom: 25px;
    }

    .bet-label {
        font-size: 0.9rem;
        color: var(--gray-text);
        margin-bottom: 10px;
        display: block;
    }

    .bet-input {
        width: 100%;
        padding: 12px;
        background: rgba(0, 0, 0, 0.3);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-lg);
        color: var(--light-text);
        font-size: 1.1rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 15px;
    }

    .preset-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 15px;
    }

    .preset-btn {
        padding: 10px;
        background: rgba(255, 215, 0, 0.1);
        border: 2px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        color: var(--accent-gold);
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .preset-btn:hover {
        background: rgba(255, 215, 0, 0.2);
        transform: translateY(-2px);
    }

    .start-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        border: none;
        border-radius: var(--radius-lg);
        color: #000;
        font-size: 1.2rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        margin-bottom: 20px;
    }

    .start-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    .start-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .game-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-box {
        background: rgba(0, 0, 0, 0.3);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 15px;
        text-align: center;
    }

    .info-box {
        background: rgba(255, 215, 0, 0.05);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: var(--radius-lg);
        padding: 15px;
        font-size: 0.85rem;
        line-height: 1.6;
        color: var(--gray-text);
    }

    .controls-info {
        background: rgba(0, 217, 255, 0.05);
        border: 1px solid rgba(0, 217, 255, 0.2);
        border-radius: var(--radius-lg);
        padding: 15px;
        margin-bottom: 15px;
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--accent-cyan);
    }

    @media (max-width: 968px) {
        .racing-game-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="game-container">
    <div class="racing-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🏎️ RACING GAME 🏁</h1>
            
            <div class="game-canvas-container">
                <canvas id="racingCanvas" width="600" height="800"></canvas>
            </div>

            <div class="game-stats-bar">
                <div class="stat-item">
                    <div class="stat-label">Distance</div>
                    <div class="stat-value" id="distance">0%</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Speed</div>
                    <div class="stat-value" id="speed">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Multiplier</div>
                    <div class="stat-value" id="multiplier">1x</div>
                </div>
            </div>
        </div>

        <div class="controls-panel">
            <h2 class="controls-title">🎮 Game Controls</h2>

            <div class="controls-info">
                <strong>🎮 Controls:</strong><br>
                ⬅️ Left Arrow - Move Left<br>
                ➡️ Right Arrow - Move Right<br>
                ⬆️ Up Arrow - Speed Boost<br>
                Avoid traffic & reach the finish!
            </div>

            <div class="bet-controls">
                <label class="bet-label">Bet Amount:</label>
                <input type="number" id="betAmount" class="bet-input" value="500" min="200" max="5500" step="100">
                
                <div class="preset-buttons">
                    <button class="preset-btn" onclick="setBet(200)">200</button>
                    <button class="preset-btn" onclick="setBet(500)">500</button>
                    <button class="preset-btn" onclick="setBet(1000)">1K</button>
                    <button class="preset-btn" onclick="setBet(2000)">2K</button>
                    <button class="preset-btn" onclick="setBet(3500)">3.5K</button>
                    <button class="preset-btn" onclick="setBet(getBalance())">MAX</button>
                </div>

                <div style="text-align: center; margin-bottom: 10px;">
                    <span style="color: var(--gray-text); font-size: 0.9rem;">Current Bet: </span>
                    <span id="betDisplay" style="color: var(--accent-gold); font-weight: 700; font-size: 1.1rem;">₹500.00</span>
                </div>
            </div>

            <button id="startButton" class="start-btn">🏁 START RACE 🏁</button>

            <div class="game-stats">
                <div class="stat-box">
                    <div class="stat-label">Your Balance</div>
                    <div class="stat-value" id="balance">₹0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Current Bet</div>
                    <div class="stat-value" id="currentBet">₹500.00</div>
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
                1. Set your bet amount<br>
                2. Click START RACE<br>
                3. Use arrow keys to control<br>
                4. Avoid traffic obstacles<br>
                5. Reach 100% to win!<br>
                6. Faster finish = higher multiplier!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('racingCanvas');
const ctx = canvas.getContext('2d');

let totalRaces = 0;
let totalWon = 0;
let gameInterval = null;
let keys = {};

const gameState = {
    active: false,
    player: {
        x: canvas.width / 2 - 20,
        y: canvas.height - 120,
        width: 40,
        height: 70,
        speed: 5,
        type: 'car' // car, bike, or truck
    },
    obstacles: [],
    distance: 0,
    speed: 0,
    multiplier: 1,
    bet: 500,
    roadOffset: 0
};

// Vehicle designs
function drawCar(x, y, width, height, color) {
    // Car body
    ctx.fillStyle = color;
    ctx.fillRect(x, y + 10, width, height - 20);
    
    // Car top
    ctx.fillStyle = color;
    ctx.fillRect(x + 5, y, width - 10, 20);
    
    // Windows
    ctx.fillStyle = '#87CEEB';
    ctx.fillRect(x + 8, y + 3, width - 16, 12);
    
    // Wheels
    ctx.fillStyle = '#000';
    ctx.fillRect(x - 3, y + 15, 8, 12);
    ctx.fillRect(x + width - 5, y + 15, 8, 12);
    ctx.fillRect(x - 3, y + height - 27, 8, 12);
    ctx.fillRect(x + width - 5, y + height - 27, 8, 12);
    
    // Headlights
    ctx.fillStyle = '#FFFF00';
    ctx.fillRect(x + 5, y + height - 12, 10, 6);
    ctx.fillRect(x + width - 15, y + height - 12, 10, 6);
}

function drawBike(x, y, width, height, color) {
    // Bike body
    ctx.fillStyle = color;
    ctx.fillRect(x + width/4, y + 10, width/2, height - 30);
    
    // Handlebars
    ctx.fillStyle = '#888';
    ctx.fillRect(x + width/4 - 5, y + 5, width/2 + 10, 8);
    
    // Wheels
    ctx.fillStyle = '#000';
    ctx.beginPath();
    ctx.arc(x + width/4, y + height - 10, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.beginPath();
    ctx.arc(x + 3*width/4, y + height - 10, 8, 0, Math.PI * 2);
    ctx.fill();
    
    // Headlight
    ctx.fillStyle = '#FFFF00';
    ctx.fillRect(x + width/2 - 3, y + height - 25, 6, 4);
}

function drawTruck(x, y, width, height, color) {
    // Truck cargo
    ctx.fillStyle = color;
    ctx.fillRect(x, y, width, height - 25);
    
    // Truck cab
    ctx.fillStyle = color;
    ctx.fillRect(x, y + height - 30, width, 25);
    
    // Windows
    ctx.fillStyle = '#87CEEB';
    ctx.fillRect(x + 5, y + height - 27, width - 10, 12);
    
    // Wheels
    ctx.fillStyle = '#000';
    ctx.fillRect(x - 3, y + height - 15, 10, 12);
    ctx.fillRect(x + width - 7, y + height - 15, 10, 12);
    
    // Headlights
    ctx.fillStyle = '#FFFF00';
    ctx.fillRect(x + 5, y + height - 8, 12, 6);
    ctx.fillRect(x + width - 17, y + height - 8, 12, 6);
}

function drawPlayer() {
    drawCar(gameState.player.x, gameState.player.y, gameState.player.width, gameState.player.height, '#00D9FF');
}

function drawRoad() {
    // Road background
    ctx.fillStyle = '#333';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Road lines
    ctx.strokeStyle = '#FFF';
    ctx.lineWidth = 3;
    ctx.setLineDash([20, 20]);
    
    for (let i = 0; i < 3; i++) {
        const x = (canvas.width / 4) * (i + 1);
        ctx.beginPath();
        ctx.moveTo(x, 0);
        ctx.lineTo(x, canvas.height);
        ctx.stroke();
    }
    
    ctx.setLineDash([]);
    
    // Side lines
    ctx.strokeStyle = '#FFD700';
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.moveTo(10, 0);
    ctx.lineTo(10, canvas.height);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(canvas.width - 10, 0);
    ctx.lineTo(canvas.width - 10, canvas.height);
    ctx.stroke();
}

function createObstacle() {
    const lanes = [50, 150, 250, 350, 450];
    const lane = lanes[Math.floor(Math.random() * lanes.length)];
    const types = ['car', 'bike', 'truck'];
    const type = types[Math.floor(Math.random() * types.length)];
    const colors = ['#FF4444', '#FF8800', '#8844FF', '#FF44FF', '#44FF44'];
    
    let width, height;
    if (type === 'bike') {
        width = 30;
        height = 50;
    } else if (type === 'truck') {
        width = 50;
        height = 80;
    } else {
        width = 40;
        height = 70;
    }
    
    gameState.obstacles.push({
        x: lane,
        y: -height,
        width: width,
        height: height,
        type: type,
        color: colors[Math.floor(Math.random() * colors.length)]
    });
}

function updateGame() {
    if (!gameState.active) return;
    
    // Player movement
    if (keys['ArrowLeft'] && gameState.player.x > 20) {
        gameState.player.x -= gameState.player.speed;
    }
    if (keys['ArrowRight'] && gameState.player.x < canvas.width - gameState.player.width - 20) {
        gameState.player.x += gameState.player.speed;
    }
    if (keys['ArrowUp']) {
        gameState.speed = Math.min(gameState.speed + 1, 100);
    } else {
        gameState.speed = Math.max(gameState.speed - 0.5, 30);
    }
    
    // Update distance
    gameState.distance += gameState.speed / 100;
    gameState.multiplier = 1 + (gameState.speed / 50);
    
    // Update obstacles
    gameState.obstacles.forEach(obs => {
        obs.y += 3 + (gameState.speed / 20);
    });
    
    // Remove off-screen obstacles
    gameState.obstacles = gameState.obstacles.filter(obs => obs.y < canvas.height);
    
    // Create new obstacles
    if (Math.random() < 0.02) {
        createObstacle();
    }
    
    // Collision detection
    gameState.obstacles.forEach(obs => {
        if (gameState.player.x < obs.x + obs.width &&
            gameState.player.x + gameState.player.width > obs.x &&
            gameState.player.y < obs.y + obs.height &&
            gameState.player.y + gameState.player.height > obs.y) {
            endGame(false);
        }
    });
    
    // Win condition
    if (gameState.distance >= 100) {
        endGame(true);
    }
    
    // Update display
    document.getElementById('distance').textContent = Math.floor(gameState.distance) + '%';
    document.getElementById('speed').textContent = Math.floor(gameState.speed);
    document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(2) + 'x';
}

function drawGame() {
    drawRoad();
    
    // Draw obstacles
    gameState.obstacles.forEach(obs => {
        if (obs.type === 'bike') {
            drawBike(obs.x, obs.y, obs.width, obs.height, obs.color);
        } else if (obs.type === 'truck') {
            drawTruck(obs.x, obs.y, obs.width, obs.height, obs.color);
        } else {
            drawCar(obs.x, obs.y, obs.width, obs.height, obs.color);
        }
    });
    
    // Draw player
    drawPlayer();
}

function gameLoop() {
    updateGame();
    drawGame();
    if (gameState.active) {
        requestAnimationFrame(gameLoop);
    }
}

function endGame(won) {
    gameState.active = false;
    clearInterval(gameInterval);
    
    const winAmount = won ? gameState.bet * gameState.multiplier : 0;
    totalRaces++;
    totalWon += winAmount;
    
    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount: winAmount - gameState.bet })
    }).then(r => r.json()).then(d => {
        document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
        document.getElementById('totalRaces').textContent = totalRaces;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});
        
        if (won) {
            showNotification(`Race completed! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})} with ${gameState.multiplier.toFixed(2)}x multiplier!`, 'success');
        } else {
            showNotification('Crashed! Better luck next time!', 'error');
        }
        
        document.getElementById('startButton').disabled = false;
    });
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
    document.getElementById('currentBet').textContent = '₹' + bet.toLocaleString('en-IN', {minimumFractionDigits: 2});
}

function startGame() {
    if (gameState.active) return;
    
    getBalance().then(balance => {
        const bet = parseFloat(document.getElementById('betAmount').value);
        
        if (bet < 200 || bet > 5500) {
            showNotification('Bet must be between ₹200 and ₹5,500', 'error');
            return;
        }
        
        if (bet > balance) {
            showNotification('Insufficient balance!', 'error');
            return;
        }
        
        gameState.bet = bet;
        gameState.active = true;
        gameState.distance = 0;
        gameState.speed = 30;
        gameState.multiplier = 1;
        gameState.obstacles = [];
        gameState.player.x = canvas.width / 2 - 20;
        
        document.getElementById('startButton').disabled = true;
        
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ amount: -bet })
        }).then(r => r.json()).then(d => {
            document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            gameLoop();
        });
    });
}

function showNotification(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// Keyboard controls
document.addEventListener('keydown', (e) => {
    keys[e.key] = true;
});

document.addEventListener('keyup', (e) => {
    keys[e.key] = false;
});

document.getElementById('startButton').addEventListener('click', startGame);
document.getElementById('betAmount').addEventListener('input', updateBetDisplay);

// Initialize
drawRoad();
drawPlayer();

getBalance().then(balance => {
    document.getElementById('balance').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
