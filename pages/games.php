<?php
require_once '../includes/config.php';
$page_title = "All Games";
include '../includes/header.php';
?>

<style>
    .games-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .games-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .games-header p {
        font-size: 1.1rem;
        color: var(--gray-text);
    }

    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .game-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .game-card:hover {
        border-color: var(--accent-gold);
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
        transform: translateY(-10px);
    }

    .game-card-header {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.3), rgba(157, 78, 221, 0.3));
        padding: 30px 20px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .game-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .game-card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-gold);
        margin-bottom: 10px;
    }

    .game-card-subtitle {
        color: var(--gray-text);
        font-size: 0.9rem;
    }

    .game-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .game-description {
        color: var(--gray-text);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .game-features {
        list-style: none;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .game-features li {
        color: var(--gray-text);
        margin-bottom: 8px;
        padding-left: 20px;
        position: relative;
    }

    .game-features li:before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--accent-green);
        font-weight: 700;
    }

    .game-card-footer {
        padding: 20px;
        border-top: 1px solid var(--border-color);
    }

    .play-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
        color: #000;
        border: none;
        border-radius: var(--radius-lg);
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .play-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    @media (max-width: 768px) {
        .games-header h1 {
            font-size: 1.8rem;
        }

        .games-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="games-header">
    <h1>🎮 ALL GAMES 🎮</h1>
    <p>Choose your favorite game and start playing with ₹10,000 virtual currency</p>
</div>

<div class="games-grid">
    <!-- Dice Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🎲</div>
            <div class="game-card-title">DICE GAME</div>
            <div class="game-card-subtitle">Predict the outcome</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Roll two dice and predict if the total will be high or low. Simple, exciting, and fast-paced!</p>
            <ul class="game-features">
                <li>2x Multiplier on Win</li>
                <li>Instant Results</li>
                <li>Real-time Stats</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/dice.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Mines Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">💎</div>
            <div class="game-card-title">MINES</div>
            <div class="game-card-subtitle">Avoid the mines</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Reveal tiles without hitting mines. The more tiles you reveal, the higher your multiplier!</p>
            <ul class="game-features">
                <li>Progressive Multipliers</li>
                <li>Cashout Anytime</li>
                <li>Risk vs Reward</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/mines.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Chicken Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🐔</div>
            <div class="game-card-title">CHICKEN</div>
            <div class="game-card-subtitle">Navigate obstacles</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Guide the chicken through obstacles and collect eggs for bonus points. Cashout anytime!</p>
            <ul class="game-features">
                <li>Skill-Based Gameplay</li>
                <li>Collect Bonuses</li>
                <li>Live Cashout</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/chicken.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Plinko Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🎯</div>
            <div class="game-card-title">PLINKO</div>
            <div class="game-card-subtitle">Drop balls & win</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Drop balls through pegs and watch them land in multiplier slots. Multiple balls at once!</p>
            <ul class="game-features">
                <li>Multiple Ball Drops</li>
                <li>Physics-Based</li>
                <li>Up to 5x Multiplier</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/plinko.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Lucky Spin -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🎡</div>
            <div class="game-card-title">LUCKY SPIN</div>
            <div class="game-card-subtitle">Spin to win</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Spin the wheel and land on multipliers. Beautiful animations and exciting rewards!</p>
            <ul class="game-features">
                <li>Smooth Animations</li>
                <li>Variable Multipliers</li>
                <li>Instant Payouts</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/lucky-spin.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Guess the Number -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🔮</div>
            <div class="game-card-title">GUESS THE NO</div>
            <div class="game-card-subtitle">1-7 prediction</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Guess a number between 1-7. Correct guess wins 7x your bet. Simple and thrilling!</p>
            <ul class="game-features">
                <li>7x Multiplier Win</li>
                <li>Quick Rounds</li>
                <li>High Win Potential</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/guess-the-no.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Shooting Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🎯</div>
            <div class="game-card-title">SHOOTING</div>
            <div class="game-card-subtitle">Aim and shoot</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Test your accuracy by shooting targets. More hits = higher multiplier. Action-packed fun!</p>
            <ul class="game-features">
                <li>Skill-Based Action</li>
                <li>Hit Multipliers</li>
                <li>Real-time Scoring</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/shooting.php'">PLAY NOW</button>
        </div>
    </div>

    <!-- Racing Game -->
    <div class="game-card">
        <div class="game-card-header">
            <div class="game-icon">🏎️</div>
            <div class="game-card-title">RACING</div>
            <div class="game-card-subtitle">Speed to victory</div>
        </div>
        <div class="game-card-body">
            <p class="game-description">Race against the clock and land on multiplier zones. Faster finishes = bigger rewards!</p>
            <ul class="game-features">
                <li>Time-Based Multipliers</li>
                <li>Speed Bonus</li>
                <li>Zone Rewards</li>
            </ul>
        </div>
        <div class="game-card-footer">
            <button class="play-btn" onclick="window.location.href='/games/racing.php'">PLAY NOW</button>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
