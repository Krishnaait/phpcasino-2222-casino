    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>About Us</h3>
                <p><?php echo COMPANY_NAME; ?> is a 100% free-to-play social gaming platform for entertainment purposes only.</p>
                <p style="margin-top: 10px; font-size: 0.9rem;">
                    <strong>CIN:</strong> <?php echo COMPANY_CIN; ?><br>
                    <strong>GST:</strong> <?php echo COMPANY_GST; ?><br>
                    <strong>PAN:</strong> <?php echo COMPANY_PAN; ?>
                </p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/pages/games.php">Games</a></li>
                    <li><a href="/pages/about.php">About Us</a></li>
                    <li><a href="/pages/contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Legal</h3>
                <ul>
                    <li><a href="/pages/privacy.php">Privacy Policy</a></li>
                    <li><a href="/pages/terms.php">Terms & Conditions</a></li>
                    <li><a href="/pages/disclaimer.php">Disclaimer</a></li>
                    <li><a href="/pages/responsible-gaming.php">Responsible Gaming</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact</h3>
                <p>
                    <strong>Email:</strong> <?php echo COMPANY_EMAIL; ?><br>
                    <strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?>
                </p>
                <p style="margin-top: 15px;">
                    <strong>Follow Us:</strong><br>
                    <a href="#" style="margin-right: 10px;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="margin-right: 10px;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="margin-right: 10px;"><i class="fab fa-instagram"></i></a>
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="legal-disclaimer">
                <span class="age-badge">18+ ONLY</span>
                <strong>Legal Disclaimer:</strong> <?php echo COMPANY_NAME; ?> is a 100% free-to-play social gaming platform for entertainment purposes only. All currency (₹) is virtual and has zero real-world value. No real money gambling. No prizes. No withdrawals. Must be 18+ to play. This is not gambling - it's entertainment only.
            </div>
            <p>&copy; <?php echo date('Y'); ?> <?php echo COMPANY_NAME; ?>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Global JavaScript -->
    <script>
        // Update balance in real-time
        function updateBalanceDisplay() {
            fetch('/api/get-balance.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('balanceDisplay').textContent = '₹' + data.balance.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                })
                .catch(error => console.log('Balance update error:', error));
        }

        // Update balance every 2 seconds
        setInterval(updateBalanceDisplay, 2000);

        // Reset balance function
        function resetBalance() {
            if (confirm('Are you sure you want to reset your balance to ₹10,000?')) {
                fetch('/api/reset-balance.php', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('balanceDisplay').textContent = '₹' + data.balance.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        showNotification('Balance reset to ₹10,000', 'success');
                    }
                })
                .catch(error => console.log('Reset error:', error));
            }
        }

        // Show notification
        function showNotification(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add slideOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
