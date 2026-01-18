<?php
require_once '../includes/config.php';
$page_title = "Responsible Gaming";
include '../includes/header.php';
?>

<style>
    .responsible-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .responsible-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 10px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .responsible-header p {
        color: var(--gray-text);
        font-size: 1rem;
    }

    .responsible-content {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
    }

    .responsible-section {
        margin-bottom: 35px;
    }

    .responsible-section h2 {
        font-size: 1.4rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.2);
    }

    .responsible-section p {
        color: var(--gray-text);
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .responsible-section ul {
        color: var(--gray-text);
        margin-left: 20px;
        line-height: 1.8;
    }

    .responsible-section li {
        margin-bottom: 8px;
    }

    .highlight-box {
        background: rgba(0, 255, 0, 0.1);
        border-left: 4px solid var(--accent-green);
        padding: 20px;
        margin: 25px 0;
        border-radius: var(--radius-lg);
    }

    .highlight-box strong {
        color: var(--accent-green);
        font-size: 1.1rem;
    }

    .highlight-box p {
        color: #fff;
        margin-top: 10px;
    }

    .warning-box {
        background: rgba(255, 165, 0, 0.1);
        border-left: 4px solid #ffa500;
        padding: 20px;
        margin: 25px 0;
        border-radius: var(--radius-lg);
    }

    .warning-box strong {
        color: #ffa500;
        font-size: 1.1rem;
    }

    .warning-box p {
        color: #fff;
        margin-top: 10px;
    }

    .help-resources {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .help-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .help-card:hover {
        border-color: var(--accent-gold);
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
    }

    .help-card h3 {
        color: var(--accent-gold);
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .help-card p {
        color: var(--gray-text);
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .help-card a {
        color: var(--accent-gold);
        text-decoration: none;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .help-card a:hover {
        color: #ffed4e;
    }

    @media (max-width: 768px) {
        .responsible-header h1 {
            font-size: 1.8rem;
        }

        .responsible-content {
            padding: 25px;
        }

        .responsible-section h2 {
            font-size: 1.2rem;
        }

        .help-resources {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="responsible-header">
    <h1>🛡️ Responsible Gaming 🛡️</h1>
    <p>Your well-being is our priority - Play responsibly and stay in control</p>
</div>

<div class="responsible-content">
    <div class="highlight-box">
        <strong>✅ Entertainment First</strong>
        <p>
            This platform is designed for entertainment purposes only. All games use virtual currency with zero real-world value. No real money is involved, making it a safe environment for recreational gaming.
        </p>
    </div>

    <div class="responsible-section">
        <h2>1. Our Commitment to Responsible Gaming</h2>
        <p>
            At Casino PRIVATE LIMITED, we are committed to promoting responsible gaming practices. While our platform uses virtual currency and involves no real money, we believe it's important to encourage healthy gaming habits and provide resources for those who may need support.
        </p>
        <p>
            We strive to create a safe, enjoyable environment where entertainment comes first, and we actively promote awareness about responsible gaming behaviors.
        </p>
    </div>

    <div class="responsible-section">
        <h2>2. What is Responsible Gaming?</h2>
        <p>
            Responsible gaming means maintaining control over your gaming activities and ensuring that gaming remains a fun, recreational activity rather than a problem. It involves:
        </p>
        <ul>
            <li>Setting personal limits on time spent gaming</li>
            <li>Understanding that gaming is entertainment, not a way to make money</li>
            <li>Being aware of the signs of problematic gaming behavior</li>
            <li>Knowing when to take breaks and step away</li>
            <li>Seeking help if gaming becomes a concern</li>
        </ul>
    </div>

    <div class="responsible-section">
        <h2>3. Tips for Responsible Gaming</h2>
        <p>
            Follow these guidelines to ensure your gaming experience remains positive and enjoyable:
        </p>
        
        <h3 style="color: var(--accent-gold); margin-top: 20px; margin-bottom: 10px;">⏰ Set Time Limits</h3>
        <ul>
            <li>Decide in advance how much time you'll spend gaming</li>
            <li>Use alarms or timers to remind yourself to take breaks</li>
            <li>Don't let gaming interfere with work, family, or social obligations</li>
            <li>Take regular breaks every 30-60 minutes</li>
        </ul>

        <h3 style="color: var(--accent-gold); margin-top: 20px; margin-bottom: 10px;">🎯 Keep Perspective</h3>
        <ul>
            <li>Remember that this is entertainment, not a source of income</li>
            <li>Understand that all currency is virtual with no real-world value</li>
            <li>Don't chase losses or try to "win back" virtual credits</li>
            <li>Accept that outcomes are based on chance and RNG</li>
        </ul>

        <h3 style="color: var(--accent-gold); margin-top: 20px; margin-bottom: 10px;">🧘 Balance Your Life</h3>
        <ul>
            <li>Maintain a healthy balance between gaming and other activities</li>
            <li>Ensure gaming doesn't replace physical activity or social interaction</li>
            <li>Don't use gaming as an escape from problems or stress</li>
            <li>Prioritize responsibilities before recreational gaming</li>
        </ul>

        <h3 style="color: var(--accent-gold); margin-top: 20px; margin-bottom: 10px;">👨‍👩‍👧 Protect Minors</h3>
        <ul>
            <li>This website is for users 18 years and older only</li>
            <li>Parents should monitor their children's internet usage</li>
            <li>Use parental controls to restrict access if needed</li>
            <li>Educate children about responsible gaming practices</li>
        </ul>
    </div>

    <div class="responsible-section">
        <h2>4. Recognizing Problem Gaming</h2>
        <p>
            While this platform involves no real money, it's still important to recognize signs of problematic gaming behavior:
        </p>
        <div class="warning-box">
            <strong>⚠️ Warning Signs</strong>
            <ul style="margin-top: 15px; color: #fff;">
                <li>Gaming for longer periods than intended</li>
                <li>Neglecting work, school, or family responsibilities</li>
                <li>Using gaming to escape from problems or negative feelings</li>
                <li>Becoming irritable or restless when not gaming</li>
                <li>Lying about the amount of time spent gaming</li>
                <li>Losing interest in other hobbies or activities</li>
                <li>Gaming interfering with sleep or eating patterns</li>
            </ul>
        </div>
        <p>
            If you recognize any of these signs in yourself or someone you know, it may be time to seek help or take a break from gaming.
        </p>
    </div>

    <div class="responsible-section">
        <h2>5. Self-Assessment Questions</h2>
        <p>
            Ask yourself these questions honestly:
        </p>
        <ul>
            <li>Do I spend more time gaming than I originally planned?</li>
            <li>Has gaming caused me to neglect important responsibilities?</li>
            <li>Do I feel guilty or anxious about my gaming habits?</li>
            <li>Have friends or family expressed concern about my gaming?</li>
            <li>Do I use gaming to avoid dealing with problems?</li>
            <li>Has my gaming affected my relationships or work performance?</li>
        </ul>
        <p>
            If you answered "yes" to several of these questions, consider taking a break and seeking support.
        </p>
    </div>

    <div class="responsible-section">
        <h2>6. Taking Control</h2>
        <p>
            If you're concerned about your gaming habits, here are steps you can take:
        </p>
        <ul>
            <li><strong>Take a Break:</strong> Step away from gaming for a period of time</li>
            <li><strong>Set Strict Limits:</strong> Use timers and stick to predetermined time limits</li>
            <li><strong>Find Alternatives:</strong> Engage in other hobbies and activities</li>
            <li><strong>Talk to Someone:</strong> Share your concerns with friends, family, or a counselor</li>
            <li><strong>Seek Professional Help:</strong> Contact a gambling addiction helpline or counselor</li>
            <li><strong>Use Browser Tools:</strong> Clear your browser data to reset your session</li>
        </ul>
    </div>

    <div class="responsible-section">
        <h2>7. Help & Support Resources</h2>
        <p>
            If you or someone you know needs help with gambling-related issues, these organizations provide free, confidential support:
        </p>
        
        <div class="help-resources">
            <div class="help-card">
                <h3>🌐 National Council on Problem Gambling</h3>
                <p>24/7 confidential helpline and resources</p>
                <a href="https://www.ncpgambling.org" target="_blank">Visit Website</a><br>
                <a href="tel:1-800-522-4700" style="color: var(--accent-gold); margin-top: 10px; display: inline-block;">1-800-522-4700</a>
            </div>

            <div class="help-card">
                <h3>🤝 Gamblers Anonymous</h3>
                <p>International fellowship for problem gamblers</p>
                <a href="https://www.gamblersanonymous.org" target="_blank">Visit Website</a>
            </div>

            <div class="help-card">
                <h3>💬 GamCare</h3>
                <p>Free information, advice and support</p>
                <a href="https://www.gamcare.org.uk" target="_blank">Visit Website</a><br>
                <a href="tel:0808-8020-133" style="color: var(--accent-gold); margin-top: 10px; display: inline-block;">0808 8020 133</a>
            </div>

            <div class="help-card">
                <h3>🛡️ BeGambleAware</h3>
                <p>Independent charity providing help and support</p>
                <a href="https://www.begambleaware.org" target="_blank">Visit Website</a>
            </div>

            <div class="help-card">
                <h3>📞 Gambling Therapy</h3>
                <p>Free online support and counseling</p>
                <a href="https://www.gamblingtherapy.org" target="_blank">Visit Website</a>
            </div>

            <div class="help-card">
                <h3>🏥 SAMHSA National Helpline</h3>
                <p>Treatment referral and information service</p>
                <a href="tel:1-800-662-4357" style="color: var(--accent-gold);">1-800-662-HELP (4357)</a>
            </div>
        </div>
    </div>

    <div class="responsible-section">
        <h2>8. For Parents and Guardians</h2>
        <p>
            If you're a parent or guardian, here's how you can help protect minors:
        </p>
        <ul>
            <li>Monitor your children's internet usage and gaming activities</li>
            <li>Use parental control software to restrict access to gaming sites</li>
            <li>Educate children about responsible gaming and online safety</li>
            <li>Set clear rules about screen time and gaming limits</li>
            <li>Encourage alternative activities and hobbies</li>
            <li>Keep computers and devices in common areas of the home</li>
            <li>Talk openly with children about the risks of excessive gaming</li>
        </ul>
    </div>

    <div class="responsible-section">
        <h2>9. Our Role in Responsible Gaming</h2>
        <p>
            Casino PRIVATE LIMITED takes responsible gaming seriously. We:
        </p>
        <ul>
            <li>Require users to be 18 years or older</li>
            <li>Use only virtual currency with no real-world value</li>
            <li>Do not allow real money deposits or withdrawals</li>
            <li>Provide clear information about our games and their entertainment nature</li>
            <li>Offer resources and links to gambling support organizations</li>
            <li>Encourage users to set personal limits and take breaks</li>
            <li>Maintain transparency about game mechanics and RNG</li>
        </ul>
    </div>

    <div class="responsible-section">
        <h2>10. Contact Us</h2>
        <p>
            If you have concerns about responsible gaming or need assistance, please contact us:
        </p>
        <ul>
            <li><strong>Email:</strong> <?php echo COMPANY_EMAIL; ?></li>
            <li><strong>Company:</strong> <?php echo COMPANY_NAME; ?></li>
            <li><strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?></li>
        </ul>
    </div>

    <div class="highlight-box">
        <strong>🎮 Remember: Gaming Should Be Fun!</strong>
        <p>
            Gaming is meant to be an enjoyable form of entertainment. If it stops being fun or starts causing problems in your life, it's time to take a step back. Play responsibly, set limits, and don't hesitate to seek help if needed.
        </p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
