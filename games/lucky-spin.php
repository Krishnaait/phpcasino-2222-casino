<?php
require_once '../includes/config.php';
$page_title = "Lucky Spin";
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

    .spin-game-wrapper {
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

    .wheel-container {
        position: relative;
        width: 400px;
        height: 400px;
        margin: 0 auto 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wheel {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.3), inset 0 0 30px rgba(0, 0, 0, 0.5);
        transition: transform 0.1s linear;
        position: relative;
    }

    .wheel-segment {
        position: absolute;
        width: 50%;
        height: 50%;
        transform-origin: bottom right;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .pointer {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 20px solid var(--accent-gold);
        z-index: 10;
        filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.5));
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

    .spin-button {
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

    .spin-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .spin-button:disabled {
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

    @media (max-width: 968px) {
        .spin-game-wrapper {
            grid-template-columns: 1fr;
        }

        .control-panel {
            position: relative;
            top: 0;
        }

        .wheel-container {
            width: 300px;
            height: 300px;
        }

        .game-area {
            padding: 25px;
        }

        .game-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 576px) {
        .wheel-container {
            width: 250px;
            height: 250px;
        }

        .game-area {
            padding: 15px;
        }

        .wheel-segment {
            font-size: 0.9rem;
        }
    }
</style>

<div class="game-container">
    <div class="spin-game-wrapper">
        <div class="game-area">
            <h1 class="game-title">🎡 LUCKY SPIN 🎡</h1>

            <div class="wheel-container">
                <div class="pointer"></div>
                <canvas id="wheelCanvas" width="400" height="400"></canvas>
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
                </div>
            </div>

            <button class="spin-button" id="spinButton" onclick="spinWheel()">🎡 SPIN NOW 🎡</button>

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
                    <div class="stat-label">Total Spins</div>
                    <div class="stat-value" id="totalSpins">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Won</div>
                    <div class="stat-value" id="totalWon">₹0</div>
                </div>
            </div>

            <div class="info-box">
                <strong>How to Play:</strong><br>
                1. Set your bet<br>
                2. Click SPIN NOW<br>
                3. Watch the wheel<br>
                4. Land on a multiplier<br>
                5. Win instantly!
            </div>
        </div>
    </div>
</div>

<script>
const canvas = document.getElementById('wheelCanvas');
const ctx = canvas.getContext('2d');

const multipliers = [2, 3, 1.5, 4, 1, 5, 2.5, 3.5];
const colors = ['#ff6b35', '#ffd700', '#00ff00', '#00d9ff', '#9d4edd', '#ff4444', '#ffa500', '#00cc00'];

let isSpinning = false;
let totalSpins = 0;
let totalWon = 0;

function drawWheel(rotation = 0) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(200, 200);
    ctx.rotate(rotation);

    const segmentAngle = (Math.PI * 2) / multipliers.length;

    multipliers.forEach((multiplier, index) => {
        ctx.beginPath();
        ctx.arc(0, 0, 180, index * segmentAngle, (index + 1) * segmentAngle);
        ctx.lineTo(0, 0);
        ctx.fillStyle = colors[index];
        ctx.fill();
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Draw text
        ctx.save();
        ctx.rotate(index * segmentAngle + segmentAngle / 2);
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 20px Poppins';
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        ctx.fillText(multiplier + 'x', 150, 0);
        ctx.restore();
    });

    // Draw center circle
    ctx.beginPath();
    ctx.arc(0, 0, 30, 0, Math.PI * 2);
    ctx.fillStyle = '#ffd700';
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();

    ctx.restore();
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

function spinWheel() {
    if (isSpinning) return;

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

        isSpinning = true;
        document.getElementById('spinButton').disabled = true;

        // Deduct bet
        fetch('../api/update-balance.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({amount: -bet})
        });

        const winningIndex = Math.floor(Math.random() * multipliers.length);
        const winningMultiplier = multipliers[winningIndex];
        const segmentAngle = (Math.PI * 2) / multipliers.length;
        // Calculate rotation so the pointer (top center) points to the winning segment
        // Add offset to center the pointer on the segment
        const targetRotation = (Math.PI * 2 * 5) + (Math.PI * 2) - (winningIndex * segmentAngle) - (segmentAngle / 2);

        let currentRotation = 0;
        const startTime = Date.now();
        const duration = 3000;

        function animate() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function for smooth deceleration
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            currentRotation = targetRotation * easeProgress;

            drawWheel(currentRotation);

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                isSpinning = false;
                const winAmount = bet * winningMultiplier;
                totalWon += winAmount;
                totalSpins++;

                // Add winnings
                fetch('../api/update-balance.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({amount: winAmount})
                }).then(r => r.json()).then(d => {
                    document.getElementById('balanceDisplay').textContent = '₹' + d.balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
                    document.getElementById('totalSpins').textContent = totalSpins;
                    document.getElementById('totalWon').textContent = '₹' + totalWon.toLocaleString('en-IN', {minimumFractionDigits: 2});

                    document.getElementById('resultDisplay').innerHTML = `<div class="result-message win">✓ YOU WON ${winningMultiplier}x! +₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}</div>`;
                    showNotification(`You won ₹${winAmount.toLocaleString('en-IN', {minimumFractionDigits: 2})}!`, 'success');
                });

                document.getElementById('spinButton').disabled = false;
            }
        }

        animate();
    });
}

// Initialize
drawWheel();
getBalance().then(balance => {
    document.getElementById('balanceDisplay').textContent = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2});
});
updateBetDisplay();
</script>

<?php include '../includes/footer.php'; ?>
