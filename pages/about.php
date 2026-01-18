<?php
require_once '../includes/config.php';
$page_title = "About Us";
include '../includes/header.php';
?>

<style>
    .about-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .about-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .content-section {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
        margin-bottom: 30px;
    }

    .content-section h2 {
        font-size: 1.8rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
    }

    .content-section p {
        color: var(--gray-text);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .feature-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .feature-title {
        color: var(--accent-gold);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .feature-text {
        color: var(--gray-text);
        font-size: 0.9rem;
    }

    .company-info {
        background: rgba(255, 215, 0, 0.1);
        border: 2px solid var(--accent-gold);
        border-radius: var(--radius-lg);
        padding: 30px;
        margin-top: 30px;
    }

    .info-row {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 20px;
        margin-bottom: 15px;
        align-items: center;
    }

    .info-label {
        color: var(--accent-gold);
        font-weight: 700;
    }

    .info-value {
        color: var(--gray-text);
    }

    @media (max-width: 768px) {
        .about-header h1 {
            font-size: 1.8rem;
        }

        .content-section {
            padding: 25px;
        }

        .info-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="about-header">
    <h1>About Casino PRIVATE LIMITED</h1>
</div>

<div class="content-section">
    <h2>Our Mission</h2>
    <p>
        At Casino PRIVATE LIMITED, our mission is to provide a world-class, 100% free-to-play social gaming experience that combines entertainment, excitement, and innovation. We believe that gaming should be accessible to everyone without any financial barriers or risks.
    </p>
    <p>
        We are committed to delivering premium casino-style games with exceptional graphics, smooth gameplay, and fair mechanics. Our platform is designed for pure entertainment purposes, using virtual currency that has zero real-world value.
    </p>
</div>

<div class="content-section">
    <h2>Why Choose Us?</h2>
    <div class="features-grid">
        <div class="feature-box">
            <div class="feature-icon">💰</div>
            <div class="feature-title">100% Free</div>
            <div class="feature-text">No deposits, no withdrawals, no hidden costs. Pure entertainment.</div>
        </div>

        <div class="feature-box">
            <div class="feature-icon">⚡</div>
            <div class="feature-title">Instant Play</div>
            <div class="feature-text">No registration required. Start playing immediately with ₹10,000 virtual balance.</div>
        </div>

        <div class="feature-box">
            <div class="feature-icon">🎮</div>
            <div class="feature-title">8+ Games</div>
            <div class="feature-text">Diverse selection of unique casino-style games with different mechanics.</div>
        </div>

        <div class="feature-box">
            <div class="feature-icon">📱</div>
            <div class="feature-title">Mobile Friendly</div>
            <div class="feature-text">Play on any device - desktop, tablet, or smartphone with responsive design.</div>
        </div>

        <div class="feature-box">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">Secure & Fair</div>
            <div class="feature-text">Session-based gameplay with transparent game mechanics and fair RNG.</div>
        </div>

        <div class="feature-box">
            <div class="feature-icon">🌟</div>
            <div class="feature-title">Real Casino Vibe</div>
            <div class="feature-text">Premium design and animations that capture the excitement of real casinos.</div>
        </div>
    </div>
</div>

<div class="content-section">
    <h2>Our Games</h2>
    <p>
        We offer a carefully curated selection of casino-style games, each designed with unique mechanics and engaging gameplay:
    </p>
    <ul style="color: var(--gray-text); margin-left: 20px; line-height: 2;">
        <li><strong style="color: var(--accent-gold);">Dice Game</strong> - Predict HIGH or LOW on two dice rolls</li>
        <li><strong style="color: var(--accent-gold);">Mines</strong> - Reveal tiles without hitting mines</li>
        <li><strong style="color: var(--accent-gold);">Chicken</strong> - Navigate obstacles and collect bonuses</li>
        <li><strong style="color: var(--accent-gold);">Plinko</strong> - Drop balls through pegs to win multipliers</li>
        <li><strong style="color: var(--accent-gold);">Lucky Spin</strong> - Spin the wheel for instant wins</li>
        <li><strong style="color: var(--accent-gold);">Guess the Number</strong> - Pick a number between 1-7</li>
        <li><strong style="color: var(--accent-gold);">Shooting</strong> - Test your accuracy by shooting targets</li>
        <li><strong style="color: var(--accent-gold);">Racing</strong> - Race against the clock for bigger multipliers</li>
    </ul>
</div>

<div class="content-section">
    <h2>Fair Play & Transparency</h2>
    <p>
        We are committed to providing a fair and transparent gaming experience. All our games use certified random number generators (RNG) to ensure unpredictable and fair outcomes. Our platform is 100% free-to-play with no real money involved, making it a safe and entertaining experience for all players.
    </p>
    <p>
        We comply with all applicable laws and regulations, and our games are designed for entertainment purposes only. We do not offer any real money gambling, prizes, or withdrawals.
    </p>
</div>

<div class="content-section">
    <h2>Responsible Gaming</h2>
    <p>
        While our platform is designed for entertainment and uses virtual currency with zero real-world value, we encourage all players to enjoy our games responsibly. We recommend:
    </p>
    <ul style="color: var(--gray-text); margin-left: 20px; line-height: 2;">
        <li>Setting personal limits on gaming time</li>
        <li>Treating virtual currency as entertainment value only</li>
        <li>Taking regular breaks during gaming sessions</li>
        <li>Never sharing account information with others</li>
        <li>Reporting any technical issues to our support team</li>
    </ul>
</div>

<div class="company-info">
    <h2 style="color: var(--accent-gold); margin-bottom: 20px;">Company Information</h2>
    <div class="info-row">
        <div class="info-label">Company Name:</div>
        <div class="info-value"><?php echo COMPANY_NAME; ?></div>
    </div>
    <div class="info-row">
        <div class="info-label">CIN:</div>
        <div class="info-value"><?php echo COMPANY_CIN; ?></div>
    </div>
    <div class="info-row">
        <div class="info-label">GST No:</div>
        <div class="info-value"><?php echo COMPANY_GST; ?></div>
    </div>
    <div class="info-row">
        <div class="info-label">PAN No:</div>
        <div class="info-value"><?php echo COMPANY_PAN; ?></div>
    </div>
    <div class="info-row">
        <div class="info-label">Address:</div>
        <div class="info-value"><?php echo COMPANY_ADDRESS; ?></div>
    </div>
    <div class="info-row">
        <div class="info-label">Email:</div>
        <div class="info-value"><?php echo COMPANY_EMAIL; ?></div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
