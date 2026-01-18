<?php
require_once 'includes/config.php';
$page_title = "Home";
include 'includes/header.php';
?>

<style>
    /* Hero Section with Banner */
    .hero {
        position: relative;
        background: url('/assets/images/hero-banner.webp') center/cover no-repeat;
        border-radius: var(--radius-2xl);
        padding: 100px 40px;
        text-align: center;
        margin-bottom: 60px;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(75, 0, 130, 0.6));
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero h1 {
        font-size: 4rem;
        font-family: 'Playfair Display', serif;
        margin-bottom: 20px;
        color: var(--accent-gold);
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.8), 0 0 60px rgba(255, 215, 0, 0.4);
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.6), 0 0 40px rgba(255, 215, 0, 0.3);
        }
        to {
            text-shadow: 0 0 30px rgba(255, 215, 0, 1), 0 0 60px rgba(255, 215, 0, 0.6);
        }
    }

    .hero p {
        font-size: 1.4rem;
        color: #fff;
        margin-bottom: 30px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 40px;
    }

    .hero-btn {
        padding: 18px 45px;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: var(--radius-xl);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .hero-btn-primary {
        background: linear-gradient(135deg, var(--accent-gold), #ff8c00);
        color: #000;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
    }

    .hero-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
    }

    .hero-btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 2px solid var(--accent-gold);
        backdrop-filter: blur(10px);
    }

    .hero-btn-secondary:hover {
        background: rgba(255, 215, 0, 0.2);
        transform: translateY(-3px);
    }

    /* Promo Banner */
    .promo-banner {
        position: relative;
        background: url('/assets/images/promo-banner.webp') center/cover no-repeat;
        border-radius: var(--radius-2xl);
        padding: 60px 40px;
        text-align: center;
        margin-bottom: 60px;
        box-shadow: 0 10px 40px rgba(138, 43, 226, 0.4);
        overflow: hidden;
    }

    .promo-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(75, 0, 130, 0.8), rgba(138, 43, 226, 0.7));
        z-index: 1;
    }

    .promo-content {
        position: relative;
        z-index: 2;
    }

    .promo-banner h2 {
        font-size: 2.8rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    }

    .promo-banner p {
        font-size: 1.2rem;
        color: #fff;
        margin-bottom: 25px;
    }

    .promo-highlight {
        font-size: 3rem;
        font-weight: 900;
        color: var(--accent-gold);
        text-shadow: 0 0 30px rgba(255, 215, 0, 1);
        margin: 20px 0;
    }

    /* Games Section */
    .games-section {
        position: relative;
        padding: 60px 0;
        margin-bottom: 60px;
    }

    .games-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: -50px;
        right: -50px;
        bottom: 0;
        background: url('/assets/images/games-section-bg.webp') center/cover;
        opacity: 0.1;
        z-index: 0;
        border-radius: var(--radius-2xl);
    }

    .games-container {
        position: relative;
        z-index: 1;
    }

    .section-title {
        font-size: 3rem;
        font-family: 'Playfair Display', serif;
        color: var(--accent-gold);
        margin-bottom: 50px;
        text-align: center;
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
    }

    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .game-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 30px;
        text-align: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .game-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .game-card:hover::before {
        opacity: 1;
    }

    .game-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent-gold);
        box-shadow: 0 15px 40px rgba(255, 215, 0, 0.3);
    }

    .game-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
    }

    .game-title {
        font-size: 1.6rem;
        color: #fff;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .game-description {
        color: var(--gray-text);
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .play-btn {
        background: linear-gradient(135deg, var(--accent-gold), #ff8c00);
        color: #000;
        padding: 12px 35px;
        border-radius: var(--radius-lg);
        border: none;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        position: relative;
        z-index: 10;
        pointer-events: auto;
    }

    .play-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.5);
    }

    /* Features Section */
    .features-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 35px 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        border-color: var(--accent-gold);
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .feature-title {
        font-size: 1.3rem;
        color: var(--accent-gold);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .feature-text {
        color: var(--gray-text);
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }

        .hero p {
            font-size: 1.1rem;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .section-title {
            font-size: 2rem;
        }

        .games-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <div class="hero-content">
        <h1>🎰 Welcome to Casino Royale 🎰</h1>
        <p>Experience the thrill of premium casino games, completely free! No registration, no deposits - just pure entertainment.</p>
        <div class="hero-buttons">
            <a href="/pages/games.php" class="hero-btn hero-btn-primary">🎮 Play Now</a>
            <a href="/pages/about.php" class="hero-btn hero-btn-secondary">📖 Learn More</a>
        </div>
    </div>
</div>

<!-- Promo Banner -->
<div class="promo-banner">
    <div class="promo-content">
        <h2>🏆 Start with</h2>
        <div class="promo-highlight">₹10,000</div>
        <p>Free Virtual Credits - No Deposit Required!</p>
        <a href="/pages/games.php" class="hero-btn hero-btn-primary">Claim Now</a>
    </div>
</div>

<!-- Games Section -->
<div class="games-section">
    <div class="games-container">
        <h2 class="section-title">🎲 Featured Games 🎲</h2>
        <div class="games-grid">
            <div class="game-card">
                <div class="game-icon">🎲</div>
                <h3 class="game-title">Dice Game</h3>
                <p class="game-description">Predict HIGH or LOW and roll the dice! Simple yet thrilling gameplay with 2x multiplier.</p>
                <a href="/games/dice.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">💎</div>
                <h3 class="game-title">Mines</h3>
                <p class="game-description">Reveal tiles and avoid mines! Progressive multipliers with strategic cashout options.</p>
                <a href="/games/mines.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🐔</div>
                <h3 class="game-title">Chicken</h3>
                <p class="game-description">Navigate through obstacles in this skill-based runner game. How far can you go?</p>
                <a href="/games/chicken.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🎯</div>
                <h3 class="game-title">Plinko</h3>
                <p class="game-description">Drop balls through pegs and watch them bounce! Physics-based fun with multiple ball drops.</p>
                <a href="/games/plinko.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🎡</div>
                <h3 class="game-title">Lucky Spin</h3>
                <p class="game-description">Spin the wheel of fortune! 8 segments with multipliers up to 5x your bet.</p>
                <a href="/games/lucky-spin.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🔮</div>
                <h3 class="game-title">Guess the Number</h3>
                <p class="game-description">Pick a number from 1-7 and test your luck! Win 7x your bet with the right guess.</p>
                <a href="/games/guess-the-no.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🏹</div>
                <h3 class="game-title">Archery</h3>
                <p class="game-description">Hit the bullseye in this time-based archery challenge! Precision and speed matter.</p>
                <a href="/games/shooting.php" class="play-btn">PLAY NOW</a>
            </div>

            <div class="game-card">
                <div class="game-icon">🏎️</div>
                <h3 class="game-title">Racing</h3>
                <p class="game-description">Dodge traffic and reach the finish line! Speed boosts increase your multiplier.</p>
                <a href="/games/racing.php" class="play-btn">PLAY NOW</a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<h2 class="section-title">✨ Why Choose Us? ✨</h2>
<div class="features-section">
    <div class="feature-card">
        <div class="feature-icon">🎁</div>
        <h3 class="feature-title">100% Free</h3>
        <p class="feature-text">No deposits, no hidden fees. Start with ₹10,000 virtual credits instantly!</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">🔒</div>
        <h3 class="feature-title">No Registration</h3>
        <p class="feature-text">Play instantly without creating an account. Your privacy is our priority.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">🎮</div>
        <h3 class="feature-title">8 Unique Games</h3>
        <p class="feature-text">From dice to racing, enjoy a variety of exciting casino-style games.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">⚡</div>
        <h3 class="feature-title">Instant Play</h3>
        <p class="feature-text">No downloads required. Play directly in your browser on any device.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">🎲</div>
        <h3 class="feature-title">Fair & Random</h3>
        <p class="feature-text">All games use certified RNG for completely fair and unpredictable outcomes.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">📱</div>
        <h3 class="feature-title">Mobile Friendly</h3>
        <p class="feature-text">Optimized for all devices - play on desktop, tablet, or smartphone.</p>
    </div>
</div>

<script>
// Ensure all PLAY NOW buttons work by adding explicit click handlers
document.addEventListener('DOMContentLoaded', function() {
    const playButtons = document.querySelectorAll('.play-btn');
    console.log('Found', playButtons.length, 'play buttons');
    
    playButtons.forEach((button, index) => {
        const href = button.getAttribute('href');
        console.log('Button', index, 'href:', href);
        
        // Add explicit click handler as backup
        button.addEventListener('click', function(e) {
            console.log('Button clicked:', href);
            // Don't prevent default - let anchor tag work naturally
        });
        
        // Ensure button is clickable
        button.style.cursor = 'pointer';
        button.style.pointerEvents = 'auto';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
