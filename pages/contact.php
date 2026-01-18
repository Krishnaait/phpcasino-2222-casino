<?php
require_once '../includes/config.php';
$page_title = "Contact Us";
include '../includes/header.php';
?>

<style>
    .contact-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .contact-header h1 {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .contact-header p {
        color: var(--gray-text);
        font-size: 1.1rem;
    }

    .contact-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        border-color: var(--accent-gold);
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
        transform: translateY(-5px);
    }

    .contact-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .contact-card h2 {
        font-size: 1.5rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
    }

    .contact-card p {
        color: var(--gray-text);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 10px;
    }

    .contact-card a {
        color: var(--accent-gold);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-card a:hover {
        color: #ffed4e;
    }

    .info-section {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 40px;
        margin-bottom: 30px;
    }

    .info-section h2 {
        font-size: 1.8rem;
        color: var(--accent-gold);
        margin-bottom: 25px;
        text-align: center;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .info-label {
        color: var(--accent-gold);
        font-weight: 700;
        font-size: 1rem;
    }

    .info-value {
        color: var(--gray-text);
        font-size: 1rem;
    }

    .support-section {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(157, 78, 221, 0.1));
        border: 2px solid var(--accent-gold);
        border-radius: var(--radius-xl);
        padding: 40px;
        text-align: center;
    }

    .support-section h2 {
        font-size: 1.8rem;
        color: var(--accent-gold);
        margin-bottom: 15px;
    }

    .support-section p {
        color: var(--gray-text);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .support-hours {
        background: rgba(0, 0, 0, 0.3);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-top: 20px;
    }

    .support-hours h3 {
        color: var(--accent-gold);
        margin-bottom: 10px;
    }

    .support-hours p {
        color: #fff;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        .contact-header h1 {
            font-size: 1.8rem;
        }

        .contact-content {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .contact-card, .info-section, .support-section {
            padding: 25px;
        }
    }
</style>

<div class="contact-header">
    <h1>📞 Contact Us 📞</h1>
    <p>Get in touch with Casino PRIVATE LIMITED - We're here to help!</p>
</div>

<div class="contact-content">
    <div class="contact-card">
        <div class="contact-icon">📧</div>
        <h2>Email Support</h2>
        <p>For general inquiries, technical support, or feedback:</p>
        <p><a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a></p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">📍</div>
        <h2>Office Address</h2>
        <p><?php echo COMPANY_ADDRESS; ?></p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">🏢</div>
        <h2>Company Details</h2>
        <p><strong>CIN:</strong> <?php echo COMPANY_CIN; ?></p>
        <p><strong>GST:</strong> <?php echo COMPANY_GST; ?></p>
        <p><strong>PAN:</strong> <?php echo COMPANY_PAN; ?></p>
    </div>
</div>

<div class="info-section">
    <h2>📋 Company Information</h2>
    <div class="info-grid">
        <div class="info-label">Company Name:</div>
        <div class="info-value"><?php echo COMPANY_NAME; ?></div>
    </div>
    <div class="info-grid">
        <div class="info-label">Corporate Identity:</div>
        <div class="info-value"><?php echo COMPANY_CIN; ?></div>
    </div>
    <div class="info-grid">
        <div class="info-label">GST Number:</div>
        <div class="info-value"><?php echo COMPANY_GST; ?></div>
    </div>
    <div class="info-grid">
        <div class="info-label">PAN Number:</div>
        <div class="info-value"><?php echo COMPANY_PAN; ?></div>
    </div>
    <div class="info-grid">
        <div class="info-label">Registered Address:</div>
        <div class="info-value"><?php echo COMPANY_ADDRESS; ?></div>
    </div>
    <div class="info-grid">
        <div class="info-label">Email:</div>
        <div class="info-value"><a href="mailto:<?php echo COMPANY_EMAIL; ?>" style="color: var(--accent-gold);"><?php echo COMPANY_EMAIL; ?></a></div>
    </div>
</div>

<div class="support-section">
    <h2>💬 Customer Support</h2>
    <p>
        We're committed to providing excellent customer support for all our players. Whether you have questions about our games, need technical assistance, or want to provide feedback, we're here to help.
    </p>
    <p>
        <strong>Email us at:</strong> <a href="mailto:<?php echo COMPANY_EMAIL; ?>" style="color: var(--accent-gold); font-size: 1.1rem;"><?php echo COMPANY_EMAIL; ?></a>
    </p>
    
    <div class="support-hours">
        <h3>⏰ Response Time</h3>
        <p>We typically respond to all inquiries within 24-48 hours</p>
        <p style="color: var(--gray-text); font-size: 0.9rem; margin-top: 15px;">
            Please note: This is a free-to-play entertainment platform. We do not handle any monetary transactions or real money gambling inquiries.
        </p>
    </div>
</div>

<div class="info-section" style="margin-top: 30px;">
    <h2>❓ Frequently Asked Questions</h2>
    <div style="text-align: left; color: var(--gray-text); line-height: 1.8;">
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: Is this real money gambling?</strong><br>
            A: No, this is a 100% free-to-play entertainment platform. All currency is virtual and has zero real-world value.
        </p>
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: Do I need to register?</strong><br>
            A: No registration is required. You can start playing immediately with ₹10,000 virtual balance.
        </p>
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: How do I reset my balance?</strong><br>
            A: Click the "Reset Balance" button in the header to reset your virtual balance to ₹10,000.
        </p>
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: Are the games fair?</strong><br>
            A: Yes, all our games use certified random number generators (RNG) to ensure fair and unpredictable outcomes.
        </p>
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: Can I play on mobile?</strong><br>
            A: Yes, our website is fully responsive and works on all devices including smartphones and tablets.
        </p>
        <p style="margin-bottom: 15px;">
            <strong style="color: var(--accent-gold);">Q: How do I report a technical issue?</strong><br>
            A: Please email us at <?php echo COMPANY_EMAIL; ?> with details of the issue and we'll investigate promptly.
        </p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
