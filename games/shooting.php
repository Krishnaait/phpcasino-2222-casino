<?php
require_once '../includes/config.php';
$page_title = "Archery Game";
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

    .archery-game-wrapper {
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
        background: linear-gradient(180deg, #87CEEB, #90EE90);
        border: 3px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        position: relative;
        cursor: crosshair;
    }

    #archeryCanvas {
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

    .stat-value.time-warning {
        color: var(--accent-red);
        animation: pulse 0.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
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

    @media (max-width: 968px) {
        .archery-game-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="game-container">
    <div class="archery-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🏹 ARCHERY GAME 🎯</h1>
            
            <div class="game-canvas-container">
                <canvas id="archeryCanvas" width="600" height="600"></canvas>
            </div>

            <div class="game-stats-bar">
                <div class="stat-item">
                    <div class="stat-label">Time Left</div>
                    <div class="stat-value" id="timeLeft">30s</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Hits</div>
                    <div class="stat-value" id="hits">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Multiplier</div>
                    <div class="stat-value" id="multiplier">1x</div>
                </div>
            </div>
        </div>

        <div class="controls-panel">
            <h2 class="controls-title">🎮 Game Controls</h2>

            <div class="bet-controls">
                <label class="bet-label">Bet Amount:</label>
                <input type="number" id="betAmount" class="bet-input" value="500" min="200" max="5500" step="100">
                
                <div class="preset-buttons">
                    <button class="preset-btn" onclick="setBet(200)">200</button>
                    <button class="preset-btn" onclick="setBet(500)">500</button>
                    <button class="preset-btn" onclick="setBet(1000)">1K</button>
                    <button class="preset-btn" onclick="setBet(2000)">2K</button>
                    <button class="preset-btn" onclick="setBet(3500)">3.5K</button>
                </div>

                <div style="text-align: center; margin-bottom: 10px;">
                    <span style="color: var(--gray-text); font-size: 0.9rem;">Current Bet: </span>
                    <span id="betDisplay" style="color: var(--accent-gold); font-weight: 700; font-size: 1.1rem;">₹500.00</span>
                </div>
            </div>

            <button id="startButton" class="start-btn">🏹 START ARCHERY 🏹</button>

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
                1. Set your bet amount<br>
                2. Click START ARCHERY<br>
                3. Click on targets to shoot arrows<br>
                4. Hit bullseye for max points!<br>
                5. 30 seconds time limit<br>
                6. More hits = higher multiplier!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('archeryCanvas');
const ctx = canvas.getContext('2d');

let totalGames = 0;
let totalWon = 0;
let gameInterval = null;

const gameState = {
    active: false,
    timeLeft: 30,
    hits: 0,
    multiplier: 1,
    bet: 500,
    targets: [],
    arrows: []
};

class Target {
    constructor() {
        this.x = Math.random() * (canvas.width - 100) + 50;
        this.y = Math.random() * (canvas.height - 100) + 50;
        this.radius = 50;
        this.hit = false;
    }

    draw() {
        if (this.hit) return;
        
        // Draw target circles (bullseye)
        const rings = [
            { radius: this.radius, color: '#FF4444' },
            { radius: this.radius * 0.8, color: '#FFFFFF' },
            { radius: this.radius * 0.6, color: '#FF4444' },
            { radius: this.radius * 0.4, color: '#FFFFFF' },
            { radius: this.radius * 0.2, color: '#FFD700' }
        ];
        
        rings.forEach(ring => {
            ctx.beginPath();
            ctx.arc(this.x, this.y, ring.radius, 0, Math.PI * 2);
            ctx.fillStyle = ring.color;
            ctx.fill();
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.stroke();
        });
        
        // Draw center dot
        ctx.beginPath();
        ctx.arc(this.x, this.y, 5, 0, Math.PI * 2);
        ctx.fillStyle = '#000';
        ctx.fill();
    }

    isHit(x, y) {
        const dx = x - this.x;
        const dy = y - this.y;
        return Math.sqrt(dx * dx + dy * dy) < this.radius;
    }

    getScore(x, y) {
        const dx = x - this.x;
        const dy = y - this.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        
        if (distance < this.radius * 0.2) return 10; // Bullseye
        if (distance < this.radius * 0.4) return 8;
        if (distance < this.radius * 0.6) return 6;
        if (distance < this.radius * 0.8) return 4;
        return 2;
    }
}

class Arrow {
    constructor(startX, startY, targetX, targetY) {
        this.x = startX;
        this.y = startY;
        this.targetX = targetX;
        this.targetY = targetY;
        this.progress = 0;
        this.active = true;
    }

    update() {
        this.progress += 0.1;
        if (this.progress >= 1) {
            this.active = false;
            return;
        }
        
        this.x = this.x + (this.targetX - this.x) * 0.1;
        this.y = this.y + (this.targetY - this.y) * 0.1;
    }

    draw() {
        const angle = Math.atan2(this.targetY - this.y, this.targetX - this.x);
        
        ctx.save();
        ctx.translate(this.x, this.y);
        ctx.rotate(angle);
        
        // Arrow shaft
        ctx.strokeStyle = '#8B4513';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(-20, 0);
        ctx.lineTo(20, 0);
        ctx.stroke();
        
        // Arrow head
        ctx.fillStyle = '#C0C0C0';
        ctx.beginPath();
        ctx.moveTo(20, 0);
        ctx.lineTo(10, -5);
        ctx.lineTo(10, 5);
        ctx.closePath();
        ctx.fill();
        
        // Arrow feathers
        ctx.fillStyle = '#FF4444';
        ctx.beginPath();
        ctx.moveTo(-20, 0);
        ctx.lineTo(-25, -5);
        ctx.lineTo(-20, -2);
        ctx.closePath();
        ctx.fill();
        
        ctx.beginPath();
        ctx.moveTo(-20, 0);
        ctx.lineTo(-25, 5);
        ctx.lineTo(-20, 2);
        ctx.closePath();
        ctx.fill();
        
        ctx.restore();
    }
}

function createTargets() {
    gameState.targets = [];
    for (let i = 0; i < 5; i++) {
        gameState.targets.push(new Target());
    }
}

function drawBackground() {
    // Sky gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
    gradient.addColorStop(0, '#87CEEB');
    gradient.addColorStop(1, '#90EE90');
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Ground
    ctx.fillStyle = '#228B22';
    ctx.fillRect(0, canvas.height - 50, canvas.width, 50);
    
    // Grass details
    ctx.strokeStyle = '#1a6b1a';
    ctx.lineWidth = 2;
    for (let i = 0; i < canvas.width; i += 20) {
        ctx.beginPath();
        ctx.moveTo(i, canvas.height - 50);
        ctx.lineTo(i + 5, canvas.height - 60);
        ctx.stroke();
    }
}

function drawBow() {
    if (!gameState.active) return;
    
    const bowX = 50;
    const bowY = canvas.height - 100;
    
    // Bow
    ctx.strokeStyle = '#8B4513';
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(bowX, bowY, 30, -Math.PI/2, Math.PI/2, false);
    ctx.stroke();
    
    // String
    ctx.strokeStyle = '#FFF';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(bowX, bowY - 30);
    ctx.lineTo(bowX, bowY + 30);
    ctx.stroke();
}

function updateGame() {
    if (!gameState.active) return;
    
    // Update arrows
    gameState.arrows = gameState.arrows.filter(arrow => {
        if (arrow.active) {
            arrow.update();
            return true;
        }
        return false;
    });
}

function drawGame() {
    drawBackground();
    drawBow();
    
    // Draw targets
    gameState.targets.forEach(target => target.draw());
    
    // Draw arrows
    gameState.arrows.forEach(arrow => arrow.draw());
}

function gameLoop() {
    updateGame();
    drawGame();
    if (gameState.active) {
        requestAnimationFrame(gameLoop);
    }
}

function endGame() {
    gameState.active = false;
    clearInterval(gameInterval);
    
    const winAmount = gameState.bet * gameState.multiplier;
    totalGames++;
    totalWon += winAmount;
    
    fetch('../api/update-balance.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount: winAmount - gameState.bet })
    }).then(r => r.json()).then(d => {
        document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
        document.getElementById('totalGames').textContent = totalGames;
        document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});
        
        showNotification(`Game Over! You hit ${gameState.hits} targets and won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
        
        document.getElementById('startButton').disabled = false;
    });
}

canvas.addEventListener('click', (e) => {
    if (!gameState.active) return;
    
    const rect = canvas.getBoundingClientRect();
    const x = (e.clientX - rect.left) * (canvas.width / rect.width);
    const y = (e.clientY - rect.top) * (canvas.height / rect.height);
    
    // Create arrow
    const arrow = new Arrow(50, canvas.height - 100, x, y);
    gameState.arrows.push(arrow);
    
    // Check for hits
    gameState.targets.forEach(target => {
        if (!target.hit && target.isHit(x, y)) {
            target.hit = true;
            gameState.hits++;
            gameState.multiplier = 1 + (gameState.hits * 0.2);
            
            document.getElementById('hits').textContent = gameState.hits;
            document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(2) + 'x';
            
            // Create new target
            gameState.targets.push(new Target());
        }
    });
});

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
        gameState.timeLeft = 30;
        gameState.hits = 0;
        gameState.multiplier = 1;
        gameState.arrows = [];
        
        createTargets();
        
        document.getElementById('startButton').disabled = true;
        document.getElementById('hits').textContent = '0';
        document.getElementById('multiplier').textContent = '1x';
        
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ amount: -bet })
        }).then(r => r.json()).then(d => {
            document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            
            gameLoop();
            
            gameInterval = setInterval(() => {
                gameState.timeLeft--;
                const timeDisplay = document.getElementById('timeLeft');
                timeDisplay.textContent = gameState.timeLeft + 's';
                
                if (gameState.timeLeft <= 5) {
                    timeDisplay.classList.add('time-warning');
                } else {
                    timeDisplay.classList.remove('time-warning');
                }
                
                if (gameState.timeLeft <= 0) {
                    endGame();
                }
            }, 1000);
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

document.getElementById('startButton').addEventListener('click', startGame);
document.getElementById('betAmount').addEventListener('input', updateBetDisplay);

// Initialize
drawBackground();
drawBow();

getBalance().then(balance => {
    document.getElementById('balance').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
