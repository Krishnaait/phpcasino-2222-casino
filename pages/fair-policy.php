<?php
require_once '../includes/config.php';
$page_title = "Fair Policy";
include '../includes/header.php';
?>

<style>
    .fair-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .fair-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 10px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .fair-header p {
        color: var(--gray-text);
        font-size: 0.95rem;
    }

    .fair-content {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
    }

    .fair-section {
        margin-bottom: 35px;
    }

    .fair-section h2 {
        font-size: 1.4rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.2);
    }

    .fair-section h3 {
        font-size: 1.1rem;
        color: #fff;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .fair-section p {
        color: var(--gray-text);
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .fair-section ul {
        color: var(--gray-text);
        margin-left: 20px;
        line-height: 1.8;
    }

    .fair-section li {
        margin-bottom: 8px;
    }

    .highlight {
        background: rgba(0, 200, 255, 0.1);
        border-left: 4px solid #00d9ff;
        padding: 15px;
        margin: 20px 0;
        border-radius: var(--radius-lg);
    }

    .highlight strong {
        color: #00d9ff;
    }

    .rng-box {
        background: rgba(0, 255, 0, 0.05);
        border: 2px solid var(--accent-green);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin: 20px 0;
    }

    .rng-box h3 {
        color: var(--accent-green);
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .fair-header h1 {
            font-size: 1.8rem;
        }

        .fair-content {
            padding: 25px;
        }

        .fair-section h2 {
            font-size: 1.2rem;
        }
    }
</style>

<div class="fair-header">
    <h1>Fair Play Policy</h1>
    <p>Last Updated: January 2026</p>
</div>

<div class="fair-content">
    <div class="fair-section">
        <h2>1. Our Commitment to Fair Play</h2>
        <p>
            At Casino PRIVATE LIMITED, we are committed to providing a fair, transparent, and enjoyable gaming experience for all our users. This Fair Play Policy outlines how we ensure that all games on our platform are conducted fairly and with complete integrity.
        </p>
        <div class="highlight">
            <strong>Core Principle:</strong> Every game outcome is determined by certified Random Number Generators (RNG), ensuring complete fairness and unpredictability. No player has an advantage over another.
        </div>
    </div>

    <div class="fair-section">
        <h2>2. Random Number Generation (RNG)</h2>
        <p>
            All games on our platform use industry-standard Random Number Generators to determine outcomes. Our RNG system ensures:
        </p>
        <ul>
            <li><strong>True Randomness:</strong> Each outcome is independent and unpredictable</li>
            <li><strong>No Manipulation:</strong> Game results cannot be altered by us or any player</li>
            <li><strong>Equal Probability:</strong> All possible outcomes have their mathematically correct probability</li>
            <li><strong>Transparency:</strong> RNG algorithms are based on proven cryptographic methods</li>
        </ul>

        <div class="rng-box">
            <h3>How Our RNG Works</h3>
            <p>
                Our Random Number Generator uses JavaScript's built-in <code>Math.random()</code> function combined with cryptographic seeding to generate truly random numbers. Each game outcome is determined at the moment of play, ensuring no pre-determined results.
            </p>
            <p>
                <strong>Technical Details:</strong>
            </p>
            <ul>
                <li>Dice rolls: Random integer between 1-6 for each die</li>
                <li>Wheel spins: Random selection from 8 segments with equal probability</li>
                <li>Card draws: Shuffled deck using Fisher-Yates algorithm</li>
                <li>Plinko: Physics-based simulation with random initial conditions</li>
                <li>Mines: Random mine placement with guaranteed distribution</li>
            </ul>
        </div>
    </div>

    <div class="fair-section">
        <h2>3. Game-Specific Fairness</h2>
        
        <h3>Dice Game</h3>
        <p>
            Each die roll is generated independently using RNG. The probability of rolling any number (1-6) is exactly 16.67%. Total outcomes (2-12) follow standard probability distribution for two six-sided dice.
        </p>

        <h3>Lucky Spin</h3>
        <p>
            The wheel has 8 segments with multipliers: 2x, 3x, 1.5x, 4x, 1x, 5x, 2.5x, 3.5x. Each segment has an equal 12.5% chance of being selected. The visual spinning animation accurately reflects the randomly selected outcome.
        </p>

        <h3>Mines Game</h3>
        <p>
            Mine positions are randomly generated when you start each game. The number of mines is predetermined, but their locations are completely random. Each tile has an equal probability of containing a mine based on the selected difficulty level.
        </p>

        <h3>Plinko</h3>
        <p>
            Ball physics are simulated using realistic gravity and collision detection. Each peg collision introduces randomness, and the final landing position follows a natural probability distribution (bell curve), with edge multipliers being less common.
        </p>

        <h3>Chicken Game</h3>
        <p>
            Obstacle generation is randomized with controlled difficulty progression. Each obstacle's position and timing are determined by RNG to ensure fair but challenging gameplay.
        </p>

        <h3>Guess the Number</h3>
        <p>
            A random number between 1-7 is generated for each round. Each number has an equal 14.29% probability of being selected. Your guess has no influence on the outcome.
        </p>

        <h3>Archery (Shooting)</h3>
        <p>
            Target positions are randomly generated within the game area. Hit detection is based on precise pixel-perfect collision detection. Your skill in clicking targets determines your score.
        </p>

        <h3>Racing Game</h3>
        <p>
            Opponent vehicle positions and speeds are randomized. Collision detection is fair and consistent. Your driving skill and reaction time determine your success.
        </p>
    </div>

    <div class="fair-section">
        <h2>4. No Manipulation or Cheating</h2>
        <p>
            We guarantee that:
        </p>
        <ul>
            <li>Game outcomes are never pre-determined or manipulated</li>
            <li>We cannot see or influence your game results</li>
            <li>All players have equal chances of winning</li>
            <li>No "hot" or "cold" streaks are programmed into games</li>
            <li>Previous results do not influence future outcomes</li>
        </ul>
        <p>
            Any attempt to cheat, hack, or manipulate games will result in immediate termination of access to our platform.
        </p>
    </div>

    <div class="fair-section">
        <h2>5. Return to Player (RTP)</h2>
        <p>
            While our games use virtual currency with no real-world value, we maintain fair RTP (Return to Player) percentages:
        </p>
        <ul>
            <li><strong>Dice Game:</strong> 50% RTP (2x multiplier on correct prediction)</li>
            <li><strong>Lucky Spin:</strong> Variable RTP based on multiplier distribution (average ~2.5x)</li>
            <li><strong>Mines:</strong> Progressive RTP increases as you reveal more tiles</li>
            <li><strong>Plinko:</strong> Average RTP ~95% based on multiplier distribution</li>
            <li><strong>Guess the Number:</strong> 100% RTP (7x multiplier for 1 in 7 chance)</li>
        </ul>
        <p>
            These RTP values are theoretical long-term averages. Individual sessions may vary significantly due to the random nature of games.
        </p>
    </div>

    <div class="fair-section">
        <h2>6. Transparency & Accountability</h2>
        <p>
            We maintain transparency by:
        </p>
        <ul>
            <li>Clearly displaying game rules and probabilities</li>
            <li>Publishing this Fair Play Policy</li>
            <li>Using open-source RNG algorithms</li>
            <li>Providing detailed game mechanics information</li>
            <li>Responding to fairness concerns promptly</li>
        </ul>
    </div>

    <div class="fair-section">
        <h2>7. Responsible Gaming</h2>
        <p>
            Fair play also means promoting responsible gaming:
        </p>
        <ul>
            <li>All games are free-to-play with virtual currency only</li>
            <li>No real money is involved</li>
            <li>Players can reset their balance at any time</li>
            <li>Games are designed for entertainment, not profit</li>
            <li>We encourage breaks and responsible play habits</li>
        </ul>
    </div>

    <div class="fair-section">
        <h2>8. Dispute Resolution</h2>
        <p>
            If you believe a game outcome was unfair or have concerns about fairness:
        </p>
        <ul>
            <li>Contact us immediately at <?php echo COMPANY_EMAIL; ?></li>
            <li>Provide details of the game session and outcome</li>
            <li>We will investigate all fairness complaints within 48 hours</li>
            <li>If an error is found, we will take corrective action</li>
        </ul>
    </div>

    <div class="fair-section">
        <h2>9. Technical Integrity</h2>
        <p>
            We maintain technical integrity through:
        </p>
        <ul>
            <li>Regular code audits and security reviews</li>
            <li>Server-side validation of game outcomes</li>
            <li>Protection against client-side manipulation</li>
            <li>Continuous monitoring for anomalies</li>
            <li>Regular updates to fix bugs and improve fairness</li>
        </ul>
    </div>

    <div class="fair-section">
        <h2>10. Player Rights</h2>
        <p>
            As a player on our platform, you have the right to:
        </p>
        <ul>
            <li>Expect fair and random game outcomes</li>
            <li>Understand how games work</li>
            <li>Report suspected unfair play</li>
            <li>Receive prompt responses to fairness concerns</li>
            <li>Access this Fair Play Policy at any time</li>
        </ul>
    </div>

    <div class="fair-section">
        <h2>11. Updates to This Policy</h2>
        <p>
            We may update this Fair Play Policy to reflect changes in our games or fairness practices. Any significant changes will be prominently displayed on our website. Continued use of our platform constitutes acceptance of the updated policy.
        </p>
    </div>

    <div class="fair-section">
        <h2>12. Contact Us</h2>
        <p>
            For questions about fair play or to report concerns:
        </p>
        <ul>
            <li><strong>Email:</strong> <?php echo COMPANY_EMAIL; ?></li>
            <li><strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?></li>
            <li><strong>CIN:</strong> <?php echo COMPANY_CIN; ?></li>
            <li><strong>GST No:</strong> <?php echo COMPANY_GST; ?></li>
        </ul>
    </div>

    <div class="highlight">
        <strong>Our Promise:</strong> Every game on Casino PRIVATE LIMITED is fair, random, and transparent. We use certified RNG technology to ensure all players have equal chances. Your trust is our priority, and we are committed to maintaining the highest standards of fair play.
    </div>
</div>

<?php include '../includes/footer.php'; ?>
