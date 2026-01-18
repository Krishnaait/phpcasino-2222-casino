<?php
require_once '../includes/config.php';
$page_title = "Privacy Policy";
include '../includes/header.php';
?>

<style>
    .privacy-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .privacy-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 10px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .privacy-header p {
        color: var(--gray-text);
        font-size: 0.95rem;
    }

    .privacy-content {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
    }

    .privacy-section {
        margin-bottom: 35px;
    }

    .privacy-section h2 {
        font-size: 1.4rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.2);
    }

    .privacy-section h3 {
        font-size: 1.1rem;
        color: #fff;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .privacy-section p {
        color: var(--gray-text);
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .privacy-section ul {
        color: var(--gray-text);
        margin-left: 20px;
        line-height: 1.8;
    }

    .privacy-section li {
        margin-bottom: 8px;
    }

    .highlight {
        background: rgba(0, 255, 0, 0.1);
        border-left: 4px solid var(--accent-green);
        padding: 15px;
        margin: 20px 0;
        border-radius: var(--radius-lg);
    }

    .highlight strong {
        color: var(--accent-green);
    }

    @media (max-width: 768px) {
        .privacy-header h1 {
            font-size: 1.8rem;
        }

        .privacy-content {
            padding: 25px;
        }

        .privacy-section h2 {
            font-size: 1.2rem;
        }
    }
</style>

<div class="privacy-header">
    <h1>Privacy Policy</h1>
    <p>Last Updated: January 2026</p>
</div>

<div class="privacy-content">
    <div class="privacy-section">
        <h2>1. Introduction</h2>
        <p>
            Casino PRIVATE LIMITED ("we", "us", "our", or "Company") is committed to protecting your privacy. This Privacy Policy explains how we handle information on our website.
        </p>
        <div class="highlight">
            <strong>Key Point:</strong> We do not collect, store, or process any personal information from our users. Your privacy is completely protected.
        </div>
    </div>

    <div class="privacy-section">
        <h2>2. No Personal Data Collection</h2>
        <p>
            Our website is designed with privacy as the top priority. We explicitly do NOT collect:
        </p>
        <ul>
            <li>Names or email addresses</li>
            <li>Phone numbers or contact information</li>
            <li>Addresses or location data</li>
            <li>Payment or financial information</li>
            <li>Identification documents</li>
            <li>Age or demographic information</li>
            <li>Any other personally identifiable information (PII)</li>
        </ul>
        <p>
            You can use our platform completely anonymously without providing any personal details.
        </p>
    </div>

    <div class="privacy-section">
        <h2>3. Session-Based Gaming</h2>
        <p>
            All gaming data is stored locally in your browser using:
        </p>
        <ul>
            <li><strong>Browser Cookies:</strong> Used to maintain your gaming session</li>
            <li><strong>Local Storage:</strong> Used to store your virtual balance and game progress</li>
            <li><strong>Session Storage:</strong> Temporary data that expires when you close your browser</li>
        </ul>
        <p>
            This data is stored only on your device and is never transmitted to our servers. When you clear your browser data, all gaming information is permanently deleted.
        </p>
    </div>

    <div class="privacy-section">
        <h2>4. Cookies</h2>
        <p>
            Our website uses cookies for the following purposes:
        </p>
        <ul>
            <li><strong>Session Management:</strong> To maintain your gaming session</li>
            <li><strong>User Preferences:</strong> To remember your game settings</li>
            <li><strong>Balance Tracking:</strong> To store your virtual currency balance</li>
        </ul>
        <p>
            You can disable cookies in your browser settings, but this may affect your ability to use certain features of our website. Cookies are not used for tracking, advertising, or analytics purposes.
        </p>
    </div>

    <div class="privacy-section">
        <h2>5. No Third-Party Sharing</h2>
        <p>
            Since we do not collect any personal information, we cannot and do not:
        </p>
        <ul>
            <li>Share data with third parties</li>
            <li>Sell or trade user information</li>
            <li>Use data for marketing purposes</li>
            <li>Share data with advertisers</li>
            <li>Transfer data to external services</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>6. No Tracking or Analytics</h2>
        <p>
            We do not use:
        </p>
        <ul>
            <li>Google Analytics or similar tracking tools</li>
            <li>Advertising pixels or conversion tracking</li>
            <li>User behavior monitoring</li>
            <li>IP address logging for user identification</li>
            <li>Any form of user profiling</li>
        </ul>
        <p>
            Your gaming activity is completely private and is not tracked or monitored by us.
        </p>
    </div>

    <div class="privacy-section">
        <h2>7. Server Logs</h2>
        <p>
            Our web servers may automatically log:
        </p>
        <ul>
            <li>IP addresses (for server security only)</li>
            <li>Browser type and version</li>
            <li>Pages accessed and time spent</li>
            <li>Referrer information</li>
        </ul>
        <p>
            These logs are used only for server maintenance and security purposes. They are not used to identify or track individual users and are automatically deleted after a short retention period.
        </p>
    </div>

    <div class="privacy-section">
        <h2>8. Security</h2>
        <p>
            While we do not collect personal data, we implement security measures to protect the website from unauthorized access and attacks:
        </p>
        <ul>
            <li>HTTPS encryption for all data transmission</li>
            <li>Regular security updates and patches</li>
            <li>Firewall protection</li>
            <li>Regular security audits</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>9. Children's Privacy</h2>
        <p>
            Our website is not intended for children under 18 years of age. We do not knowingly collect information from children. If we become aware that a child has provided us with information, we will take steps to delete such information and terminate the child's account.
        </p>
    </div>

    <div class="privacy-section">
        <h2>10. Your Rights</h2>
        <p>
            Since we do not collect personal information, most traditional privacy rights do not apply. However, you have the right to:
        </p>
        <ul>
            <li>Clear your browser cookies and local storage at any time</li>
            <li>Use our website anonymously</li>
            <li>Disable cookies in your browser settings</li>
            <li>Contact us with privacy concerns</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>11. Changes to This Policy</h2>
        <p>
            We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated "Last Updated" date. Your continued use of the website following the posting of revised terms means that you accept and agree to the changes.
        </p>
    </div>

    <div class="privacy-section">
        <h2>12. Contact Us</h2>
        <p>
            If you have any questions about this Privacy Policy or our privacy practices, please contact us at:
        </p>
        <ul>
            <li><strong>Email:</strong> <?php echo COMPANY_EMAIL; ?></li>
            <li><strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?></li>
            <li><strong>CIN:</strong> <?php echo COMPANY_CIN; ?></li>
        </ul>
    </div>

    <div class="highlight">
        <strong>Summary:</strong> We collect zero personal information. All gaming data is stored locally in your browser. Your privacy is completely protected. You can use our platform completely anonymously.
    </div>
</div>

<?php include '../includes/footer.php'; ?>
