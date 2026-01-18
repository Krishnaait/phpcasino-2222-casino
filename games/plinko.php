<?php
require_once '../includes/config.php';
$page_title = "Plinko Game";
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

    .plinko-game-wrapper {
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

    .plinko-board {
        position: relative;
        background: rgba(0, 0, 0, 0.3);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin: 0 auto;
        box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.5);
        border: 3px solid var(--accent-gold);
    }

    #plinkoCanvas {
        display: block;
        width: 100%;
        height: auto;
    }

    .multipliers {
        display: flex;
        justify-content: space-around;
        margin-top: 15px;
        gap: 5px;
    }

    .multiplier {
        flex: 1;
        padding: 10px 5px;
        text-align: center;
        border-radius: var(--radius-lg);
        font-weight: bold;
        font-size: 0.9rem;
        border: 2px solid;
        transition: all 0.3s ease;
    }

    .multiplier.low {
        background: rgba(255, 68, 68, 0.2);
        border-color: #ff4444;
        color: #ff4444;
    }

    .multiplier.medium {
        background: rgba(255, 165, 0, 0.2);
        border-color: #ffa500;
        color: #ffa500;
    }

    .multiplier.high {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-gold);
        color: var(--accent-gold);
    }

    .multiplier.jackpot {
        background: rgba(0, 255, 0, 0.2);
        border-color: var(--accent-green);
        color: var(--accent-green);
        animation: jackpotPulse 1s ease-in-out infinite;
    }

    .multiplier.active {
        transform: scale(1.15);
        box-shadow: 0 0 20px currentColor;
    }

    @keyframes jackpotPulse {
        0%, 100% { box-shadow: 0 0 10px currentColor; }
        50% { box-shadow: 0 0 25px currentColor; }
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

    .drop-button {
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
        margin-top: 10px;
    }

    .drop-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .drop-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 20px;
    }

    .stat-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 12px;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .stat-value {
        color: var(--accent-gold);
        font-size: 1.2rem;
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

    @media (max-width: 968px) {
        .plinko-game-wrapper {
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
        .multipliers {
            gap: 3px;
        }

        .multiplier {
            padding: 8px 3px;
            font-size: 0.75rem;
        }

        .game-area {
            padding: 15px;
        }
    }
</style>

<div class="game-container">
    <div class="plinko-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🎯 PLINKO 🎯</h1>

            <div class="plinko-board">
                <canvas id="plinkoCanvas" width="600" height="500"></canvas>
            </div>

            <div class="multipliers" id="multipliers"></div>
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

            <div class="control-group">
                <label class="control-label">Risk Level:</label>
                <select id="riskLevel" class="control-select">
                    <option value="low">Low Risk</option>
                    <option value="medium" selected>Medium Risk</option>
                    <option value="high">High Risk</option>
                </select>
            </div>

            <button class="drop-button" id="dropButton" onclick="dropBall()">🎯 DROP BALL 🎯</button>

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
                    <div class="stat-label">Total Drops</div>
                    <div class="stat-value" id="totalDrops">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set bet & risk level<br>
                2. Click DROP BALL<br>
                3. Ball bounces through pegs<br>
                4. Lands in multiplier slot<br>
                5. Win instantly!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('plinkoCanvas');
const ctx = canvas.getContext('2d');

const multipliers = [5, 3, 2, 1.5, 1, 1.5, 2, 3, 5];
const colors = ['#ffd700', '#ffa500', '#00d9ff', '#9d4edd', '#00ff00', '#9d4edd', '#00d9ff', '#ffa500', '#ffd700'];

let gameState = {
    bet: 500,
    balls: [],
    pegs: [],
    totalDrops: 0,
    totalWon: 0
};

class Ball {
    constructor(betAmount) {
        this.x = canvas.width / 2;
        this.y = 30;
        this.radius = 8;
        this.vx = (Math.random() - 0.5) * 2;
        this.vy = 0;
        this.gravity = 0.5;
        this.bounce = 0.6;
        this.betAmount = betAmount;
        this.active = true;
        this.color = `hsl(${Math.random() * 360}, 70%, 60%)`;
    }

    update() {
        this.vy += this.gravity;
        this.x += this.vx;
        this.y += this.vy;

        // Boundary collision
        if (this.x - this.radius < 0 || this.x + this.radius > canvas.width) {
            this.vx *= -this.bounce;
            this.x = Math.max(this.radius, Math.min(canvas.width - this.radius, this.x));
        }

        // Peg collision
        gameState.pegs.forEach(peg => {
            const dx = this.x - peg.x;
            const dy = this.y - peg.y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < this.radius + peg.radius) {
                const angle = Math.atan2(dy, dx);
                this.vx = Math.cos(angle) * 3;
                this.vy = Math.sin(angle) * 3 * this.bounce;
            }
        });

        // Bottom collision
        if (this.y > canvas.height) {
            this.active = false;
            const slotIndex = Math.floor((this.x / canvas.width) * multipliers.length);
            const finalSlot = Math.max(0, Math.min(multipliers.length - 1, slotIndex));
            const multiplier = multipliers[finalSlot];
            const winAmount = this.betAmount * multiplier;

            gameState.totalWon += winAmount;

            fetch('../api/update-balance.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({amount: winAmount})
            }).then(r => r.json()).then(d => {
                document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
                document.getElementById('totalWon').textContent = '₹' + gameState.totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});
                showNotification(`Ball landed on ${multiplier}x! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
            });

            // Highlight winning slot
            const multiplierElements = document.querySelectorAll('.multiplier');
            multiplierElements[finalSlot].classList.add('active');
            setTimeout(() => {
                multiplierElements[finalSlot].classList.remove('active');
            }, 1000);
        }
    }

    draw() {
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 1;
        ctx.stroke();
    }
}

function initializePegs() {
    gameState.pegs = [];
    const rows = 8;
    const cols = 9;
    const pegRadius = 6;
    const spacing = (canvas.width - 100) / (cols - 1);
    const verticalSpacing = (canvas.height - 100) / (rows - 1);

    for (let row = 0; row < rows; row++) {
        for (let col = 0; col < cols; col++) {
            const x = 50 + col * spacing;
            const y = 50 + row * verticalSpacing;
            gameState.pegs.push({x, y, radius: pegRadius});
        }
    }
}

function drawBoard() {
    ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw pegs
    gameState.pegs.forEach(peg => {
        ctx.fillStyle = '#ffd700';
        ctx.beginPath();
        ctx.arc(peg.x, peg.y, peg.radius, 0, Math.PI * 2);
        ctx.fill();
    });

    // Draw balls
    gameState.balls.forEach(ball => {
        if (ball.active) {
            ball.update();
            ball.draw();
        }
    });

    // Remove inactive balls
    gameState.balls = gameState.balls.filter(ball => ball.active || ball.y < canvas.height + 50);

    requestAnimationFrame(drawBoard);
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
        gameState.bet = bet;
        updateBetDisplay();
    });
}

function updateBetDisplay() {
    const bet = parseFloat(document.getElementById('betAmount').value) || 0;
    document.getElementById('betDisplay').textContent = '₹' + bet.toLocaleString('en-IN', {minimumFractionDigits: 2});
    gameState.bet = bet;
}

function dropBall() {
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

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        }).then(r => r.json()).then(d => {
            document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            
            const ball = new Ball(bet);
            gameState.balls.push(ball);
            gameState.totalDrops++;
            document.getElementById('totalDrops').textContent = gameState.totalDrops;
        });
    });
}

function initializeMultipliers() {
    const container = document.getElementById('multipliers');
    container.innerHTML = '';
    multipliers.forEach((mult, index) => {
        const div = document.createElement('div');
        div.className = 'multiplier';
        if (mult === 5) div.classList.add('jackpot');
        else if (mult >= 3) div.classList.add('high');
        else if (mult >= 1.5) div.classList.add('medium');
        else div.classList.add('low');
        div.textContent = mult + 'x';
        container.appendChild(div);
    });
}

// Initialize
initializePegs();
initializeMultipliers();
getBalance().then(balance => {
    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
drawBoard();
</script>

<?php include '../includes/footer.php'; ?>
