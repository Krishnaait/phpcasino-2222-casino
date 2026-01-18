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
        background: linear-gradient(180deg, #0a0e27 0%, #1a1f3a 100%);
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

    @keyframes jackpotPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 10px var(--accent-green); }
        50% { transform: scale(1.05); box-shadow: 0 0 20px var(--accent-green); }
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

    .drop-btn {
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

    .drop-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    .drop-btn:disabled {
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

    .stat-label {
        font-size: 0.85rem;
        color: var(--gray-text);
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--accent-gold);
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

    #resultDisplay {
        margin-top: 15px;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .result-message {
        padding: 15px;
        border-radius: var(--radius-lg);
        font-weight: 700;
        text-align: center;
        animation: slideIn 0.3s ease;
    }

    .result-message.win {
        background: rgba(0, 255, 0, 0.1);
        border: 2px solid var(--accent-green);
        color: var(--accent-green);
    }

    @keyframes slideIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @media (max-width: 968px) {
        .plinko-game-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="game-container">
    <div class="plinko-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🎯 PLINKO 🎯</h1>
            
            <div class="plinko-board">
                <canvas id="plinkoCanvas" width="600" height="800"></canvas>
            </div>

            <div class="multipliers">
                <div class="multiplier jackpot">5x</div>
                <div class="multiplier high">3x</div>
                <div class="multiplier medium">2x</div>
                <div class="multiplier low">1x</div>
                <div class="multiplier low">0.5x</div>
                <div class="multiplier low">1x</div>
                <div class="multiplier medium">2x</div>
                <div class="multiplier high">3x</div>
                <div class="multiplier jackpot">5x</div>
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
                    <button class="preset-btn" onclick="setBet(getBalance())">MAX</button>
                </div>

                <div style="text-align: center; margin-bottom: 10px;">
                    <span style="color: var(--gray-text); font-size: 0.9rem;">Current Bet: </span>
                    <span id="betDisplay" style="color: var(--accent-gold); font-weight: 700; font-size: 1.1rem;">₹500.00</span>
                </div>
            </div>

            <div class="bet-controls" style="margin-bottom: 15px;">
                <label class="bet-label">Number of Balls:</label>
                <select id="ballCount" class="bet-input" style="padding: 10px;">
                    <option value="1">1 Ball</option>
                    <option value="3">3 Balls</option>
                    <option value="5">5 Balls</option>
                    <option value="10">10 Balls</option>
                </select>
            </div>

            <button id="dropButton" class="drop-btn">🎯 DROP BALLS 🎯</button>

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
                    <div class="stat-label">Total Drops</div>
                    <div class="stat-value" id="totalDrops">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div id="resultDisplay"></div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set your bet amount<br>
                2. Click DROP BALL<br>
                3. Watch the ball bounce through pegs<br>
                4. Land in a multiplier slot to win!<br>
                5. Higher multipliers on the edges!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('plinkoCanvas');
const ctx = canvas.getContext('2d');

const gameState = {
    balls: [],
    pegs: [],
    totalDrops: 0,
    totalWon: 0,
    isDropping: false
};

const multipliers = [5, 3, 2, 1, 0.5, 1, 2, 3, 5];
const ROWS = 12;
const COLS = 9;
const PEG_RADIUS = 5;
const BALL_RADIUS = 8;
const GRAVITY = 0.5;
const BOUNCE = 0.7;
const FRICTION = 0.99;

// Initialize pegs in circular pattern
function initPegs() {
    gameState.pegs = [];
    const startY = 80;
    const verticalSpacing = 60;
    
    for (let row = 0; row < ROWS; row++) {
        const pegsInRow = row + 3;
        const horizontalSpacing = canvas.width / (pegsInRow + 1);
        const y = startY + row * verticalSpacing;
        
        for (let col = 0; col < pegsInRow; col++) {
            const x = horizontalSpacing * (col + 1);
            gameState.pegs.push({ x, y, radius: PEG_RADIUS });
        }
    }
}

// Ball class with physics
class Ball {
    constructor(x, y, betAmount) {
        this.x = x;
        this.y = y;
        this.vx = (Math.random() - 0.5) * 2;
        this.vy = 0;
        this.radius = BALL_RADIUS;
        this.color = `hsl(${Math.random() * 60 + 30}, 100%, 50%)`;
        this.betAmount = betAmount;
        this.active = true;
        this.trail = [];
    }

    update() {
        if (!this.active) return;

        // Apply physics
        this.vy += GRAVITY;
        this.x += this.vx;
        this.y += this.vy;
        this.vx *= FRICTION;
        this.vy *= FRICTION;

        // Trail effect
        this.trail.push({ x: this.x, y: this.y });
        if (this.trail.length > 10) this.trail.shift();

        // Collision with pegs
        gameState.pegs.forEach(peg => {
            const dx = this.x - peg.x;
            const dy = this.y - peg.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            const minDist = this.radius + peg.radius;

            if (distance < minDist) {
                const angle = Math.atan2(dy, dx);
                const targetX = peg.x + Math.cos(angle) * minDist;
                const targetY = peg.y + Math.sin(angle) * minDist;
                
                this.x = targetX;
                this.y = targetY;
                
                const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                this.vx = Math.cos(angle) * speed * BOUNCE;
                this.vy = Math.sin(angle) * speed * BOUNCE;
            }
        });

        // Wall collision
        if (this.x - this.radius < 0) {
            this.x = this.radius;
            this.vx *= -BOUNCE;
        }
        if (this.x + this.radius > canvas.width) {
            this.x = canvas.width - this.radius;
            this.vx *= -BOUNCE;
        }

        // Check if reached bottom
        if (this.y > canvas.height - 50) {
            this.active = false;
            this.land();
        }
    }

    land() {
        const slotWidth = canvas.width / multipliers.length;
        const slotIndex = Math.floor(this.x / slotWidth);
        const multiplier = multipliers[Math.min(slotIndex, multipliers.length - 1)];
        const winAmount = this.betAmount * multiplier;

        gameState.totalWon += winAmount;

        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ amount: winAmount - this.betAmount })
        }).then(r => r.json()).then(d => {
            document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            document.getElementById('totalWon').textContent = '₹' + gameState.totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});
            showNotification(`Ball landed on ${multiplier}x! You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
        });

        document.getElementById('resultDisplay').innerHTML = `<div class="result-message win">✓ ${multiplier}x MULTIPLIER! +₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}</div>`;
        
        setTimeout(() => {
            gameState.isDropping = false;
            document.getElementById('dropButton').disabled = false;
        }, 1000);
    }

    draw() {
        // Draw trail
        ctx.globalAlpha = 0.3;
        this.trail.forEach((point, index) => {
            const alpha = index / this.trail.length;
            ctx.globalAlpha = alpha * 0.5;
            ctx.beginPath();
            ctx.arc(point.x, point.y, this.radius * 0.7, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
        });
        ctx.globalAlpha = 1;

        // Draw ball with glow
        ctx.shadowBlur = 15;
        ctx.shadowColor = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 2;
        ctx.stroke();
        ctx.shadowBlur = 0;
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
    document.getElementById('currentBet').textContent = '₹' + bet.toLocaleString('en-IN', {minimumFractionDigits: 2});
}

function dropBall() {
    if (gameState.isDropping) return;

    getBalance().then(balance => {
        const bet = parseFloat(document.getElementById('betAmount').value);
        const ballCount = parseInt(document.getElementById('ballCount').value);
        const totalBet = bet * ballCount;
        
        if (bet < 200 || bet > 5500) {
            showNotification('Bet must be between ₹200 and ₹5,500', 'error');
            return;
        }

        if (totalBet > balance) {
            showNotification(`Insufficient balance! Need ₹${totalBet.toLocaleString('en-IN')} for ${ballCount} balls`, 'error');
            return;
        }

        gameState.isDropping = true;
        document.getElementById('dropButton').disabled = true;

        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ amount: -totalBet })
        }).then(r => r.json()).then(d => {
            document.getElementById('balance').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
            
            // Drop multiple balls with delay
            for (let i = 0; i < ballCount; i++) {
                setTimeout(() => {
                    gameState.totalDrops++;
                    document.getElementById('totalDrops').textContent = gameState.totalDrops;

                    const startX = canvas.width / 2 + (Math.random() - 0.5) * 60;
                    const ball = new Ball(startX, 20, bet);
                    gameState.balls.push(ball);
                    
                    // Re-enable button after last ball
                    if (i === ballCount - 1) {
                        setTimeout(() => {
                            gameState.isDropping = false;
                            document.getElementById('dropButton').disabled = false;
                        }, 3000);
                    }
                }, i * 300); // 300ms delay between each ball
            }
        });
    });
}

function drawPegs() {
    gameState.pegs.forEach(peg => {
        ctx.shadowBlur = 10;
        ctx.shadowColor = '#ffd700';
        ctx.beginPath();
        ctx.arc(peg.x, peg.y, peg.radius, 0, Math.PI * 2);
        ctx.fillStyle = '#ffd700';
        ctx.fill();
        ctx.shadowBlur = 0;
    });
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    drawPegs();
    
    gameState.balls = gameState.balls.filter(ball => {
        if (ball.active) {
            ball.update();
            ball.draw();
            return true;
        }
        return false;
    });
    
    requestAnimationFrame(animate);
}

function showNotification(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// Initialize
initPegs();
animate();

document.getElementById('dropButton').addEventListener('click', dropBall);
document.getElementById('betAmount').addEventListener('input', updateBetDisplay);

// Load initial balance
getBalance().then(balance => {
    document.getElementById('balance').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
