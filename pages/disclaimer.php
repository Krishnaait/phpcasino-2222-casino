<?php
require_once '../includes/config.php';
$page_title = "Disclaimer";
include '../includes/header.php';
?>

<style>
    .disclaimer-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .disclaimer-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 10px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .disclaimer-header p {
        color: var(--gray-text);
        font-size: 0.95rem;
    }

    .disclaimer-content {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
    }

    .disclaimer-section {
        margin-bottom: 35px;
    }

    .disclaimer-section h2 {
        font-size: 1.4rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.2);
    }

    .disclaimer-section p {
        color: var(--gray-text);
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .disclaimer-section ul {
        color: var(--gray-text);
        margin-left: 20px;
        line-height: 1.8;
    }

    .disclaimer-section li {
        margin-bottom: 8px;
    }

    .warning-box {
        background: rgba(255, 0, 0, 0.1);
        border-left: 4px solid #ff0000;
        padding: 20px;
        margin: 25px 0;
        border-radius: var(--radius-lg);
    }

    .warning-box strong {
        color: #ff6b6b;
        font-size: 1.1rem;
    }

    .warning-box p {
        color: #fff;
        margin-top: 10px;
    }

    .info-box {
        background: rgba(0, 255, 0, 0.1);
        border-left: 4px solid var(--accent-green);
        padding: 20px;
        margin: 25px 0;
        border-radius: var(--radius-lg);
    }

    .info-box strong {
        color: var(--accent-green);
        font-size: 1.1rem;
    }

    .info-box p {
        color: #fff;
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .disclaimer-header h1 {
            font-size: 1.8rem;
        }

        .disclaimer-content {
            padding: 25px;
        }

        .disclaimer-section h2 {
            font-size: 1.2rem;
        }
    }
</style>

<div class="disclaimer-header">
    <h1>⚠️ Disclaimer ⚠️</h1>
    <p>Important Information - Please Read Carefully</p>
</div>

<div class="disclaimer-content">
    <div class="warning-box">
        <strong>⚠️ IMPORTANT NOTICE</strong>
        <p>
            This website is for entertainment purposes only. No real money gambling is conducted on this platform. All games use virtual currency with zero real-world value. This is not a gambling website.
        </p>
    </div>

    <div class="disclaimer-section">
        <h2>1. Entertainment Purpose Only</h2>
        <p>
            Casino PRIVATE LIMITED operates this website solely for entertainment purposes. This platform is designed to provide users with a fun, risk-free gaming experience using virtual currency that has absolutely no real-world monetary value.
        </p>
        <p>
            By using this website, you acknowledge and agree that:
        </p>
        <ul>
            <li>This is not a real money gambling website</li>
            <li>All currency used is virtual and cannot be converted to real money</li>
            <li>No deposits or withdrawals of real money are possible</li>
            <li>No prizes, rewards, or monetary compensation can be earned</li>
            <li>This platform is purely for recreational entertainment</li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>2. Age Restriction</h2>
        <p>
            This website is intended for users who are 18 years of age or older (or the legal age of majority in your jurisdiction). By accessing this website, you represent and warrant that you meet the age requirement.
        </p>
        <div class="warning-box">
            <strong>🔞 18+ Only</strong>
            <p>
                If you are under 18 years of age, you must not access or use this website. Parents and guardians are responsible for monitoring their children's internet usage.
            </p>
        </div>
    </div>

    <div class="disclaimer-section">
        <h2>3. No Real Money Gambling</h2>
        <p>
            We want to make it absolutely clear that:
        </p>
        <ul>
            <li><strong>No Real Money:</strong> This website does not involve any real money transactions</li>
            <li><strong>Virtual Currency Only:</strong> All credits, coins, or currency displayed are virtual and have zero cash value</li>
            <li><strong>No Deposits:</strong> We do not accept any form of payment or deposits</li>
            <li><strong>No Withdrawals:</strong> Virtual currency cannot be withdrawn, cashed out, or converted to real money</li>
            <li><strong>No Prizes:</strong> No real-world prizes, goods, or services can be won</li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>4. Responsible Gaming</h2>
        <p>
            While this platform uses virtual currency and involves no real money, we still encourage responsible gaming practices:
        </p>
        <ul>
            <li>Set personal time limits for gaming sessions</li>
            <li>Take regular breaks during gameplay</li>
            <li>Do not let gaming interfere with daily responsibilities</li>
            <li>Treat this as entertainment, not as a way to make money</li>
            <li>If you feel you may have a gambling problem, seek professional help</li>
        </ul>
        <p>
            For gambling addiction support, please visit:
        </p>
        <ul>
            <li>National Council on Problem Gambling: <a href="https://www.ncpgambling.org" target="_blank" style="color: var(--accent-gold);">www.ncpgambling.org</a></li>
            <li>Gamblers Anonymous: <a href="https://www.gamblersanonymous.org" target="_blank" style="color: var(--accent-gold);">www.gamblersanonymous.org</a></li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>5. No Warranties</h2>
        <p>
            This website and all content, games, and services are provided "as is" without any warranties of any kind, either express or implied. Casino PRIVATE LIMITED makes no representations or warranties regarding:
        </p>
        <ul>
            <li>The accuracy, completeness, or reliability of any content</li>
            <li>The availability or uninterrupted access to the website</li>
            <li>The fitness for any particular purpose</li>
            <li>The absence of errors, bugs, or technical issues</li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>6. Limitation of Liability</h2>
        <p>
            To the fullest extent permitted by law, Casino PRIVATE LIMITED, its directors, employees, and affiliates shall not be liable for any:
        </p>
        <ul>
            <li>Direct, indirect, incidental, or consequential damages</li>
            <li>Loss of profits, data, or business opportunities</li>
            <li>Damages arising from use or inability to use the website</li>
            <li>Technical failures, interruptions, or errors</li>
            <li>Unauthorized access to or alteration of your data</li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>7. Third-Party Links</h2>
        <p>
            Our website may contain links to third-party websites or services. These links are provided for convenience only. We do not endorse, control, or assume responsibility for the content, privacy policies, or practices of any third-party websites.
        </p>
    </div>

    <div class="disclaimer-section">
        <h2>8. Intellectual Property</h2>
        <p>
            All content on this website, including but not limited to text, graphics, logos, images, and software, is the property of Casino PRIVATE LIMITED or its licensors and is protected by copyright and intellectual property laws.
        </p>
        <p>
            You may not:
        </p>
        <ul>
            <li>Copy, reproduce, or distribute any content without permission</li>
            <li>Modify or create derivative works from our content</li>
            <li>Use our content for commercial purposes</li>
            <li>Reverse engineer or decompile any software</li>
        </ul>
    </div>

    <div class="disclaimer-section">
        <h2>9. Privacy and Data</h2>
        <p>
            We do not collect, store, or process any personal information from users. All gaming data is stored locally in your browser. For more information, please review our <a href="privacy.php" style="color: var(--accent-gold);">Privacy Policy</a>.
        </p>
    </div>

    <div class="disclaimer-section">
        <h2>10. Modifications</h2>
        <p>
            Casino PRIVATE LIMITED reserves the right to modify, suspend, or discontinue any aspect of this website at any time without prior notice. We may also modify this disclaimer at any time, and such modifications will be effective immediately upon posting.
        </p>
    </div>

    <div class="disclaimer-section">
        <h2>11. Governing Law</h2>
        <p>
            This disclaimer and your use of this website are governed by the laws of India. Any disputes arising from your use of this website shall be subject to the exclusive jurisdiction of the courts in Haryana, India.
        </p>
    </div>

    <div class="disclaimer-section">
        <h2>12. Contact Information</h2>
        <p>
            If you have any questions about this disclaimer, please contact us:
        </p>
        <ul>
            <li><strong>Email:</strong> <?php echo COMPANY_EMAIL; ?></li>
            <li><strong>Company:</strong> <?php echo COMPANY_NAME; ?></li>
            <li><strong>CIN:</strong> <?php echo COMPANY_CIN; ?></li>
            <li><strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?></li>
        </ul>
    </div>

    <div class="info-box">
        <strong>✅ Summary</strong>
        <p>
            This is a free-to-play entertainment website. No real money is involved. All currency is virtual and has zero real-world value. Users must be 18+. Play responsibly and treat this as entertainment only.
        </p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
