# 🚀 Deployment Guide - Casino PRIVATE LIMITED

Complete guide for deploying the casino website to production servers.

## 📋 Prerequisites

- PHP 7.4 or higher
- Apache 2.4+ or Nginx 1.18+
- Modern web browser support
- SSL certificate (recommended)

## 🔧 Deployment Methods

### Method 1: Direct Upload (Recommended for Shared Hosting)

1. **Download the project**
   - Download ZIP from GitHub: https://github.com/Krishnaait/phpcasino-2222-casino
   - Or use the provided `phpcasino-2222-casino.zip`

2. **Upload to server**
   - Use FTP/SFTP client (FileZilla, WinSCP, etc.)
   - Upload all files to your web root directory (e.g., `public_html`, `www`, `htdocs`)

3. **Set permissions**
   ```bash
   chmod 755 /path/to/casino
   chmod 644 /path/to/casino/*.php
   chmod 644 /path/to/casino/.htaccess
   ```

4. **Access the website**
   - Navigate to your domain: `https://yourdomain.com`

### Method 2: Git Clone (Recommended for VPS/Dedicated Servers)

1. **SSH into your server**
   ```bash
   ssh user@your-server-ip
   ```

2. **Navigate to web root**
   ```bash
   cd /var/www/html
   # or
   cd /usr/share/nginx/html
   ```

3. **Clone the repository**
   ```bash
   git clone https://github.com/Krishnaait/phpcasino-2222-casino.git
   cd phpcasino-2222-casino
   ```

4. **Set permissions**
   ```bash
   sudo chown -R www-data:www-data /var/www/html/phpcasino-2222-casino
   sudo chmod -R 755 /var/www/html/phpcasino-2222-casino
   ```

### Method 3: Docker Deployment

1. **Create Dockerfile**
   ```dockerfile
   FROM php:7.4-apache
   
   # Copy application files
   COPY . /var/www/html/
   
   # Enable Apache modules
   RUN a2enmod rewrite headers expires
   
   # Set permissions
   RUN chown -R www-data:www-data /var/www/html
   RUN chmod -R 755 /var/www/html
   
   # Expose port
   EXPOSE 80
   ```

2. **Build and run**
   ```bash
   docker build -t casino-website .
   docker run -d -p 80:80 casino-website
   ```

## 🌐 Web Server Configuration

### Apache Configuration

1. **Enable required modules**
   ```bash
   sudo a2enmod rewrite
   sudo a2enmod headers
   sudo a2enmod expires
   sudo systemctl restart apache2
   ```

2. **Virtual Host Configuration**
   Create `/etc/apache2/sites-available/casino.conf`:
   ```apache
   <VirtualHost *:80>
       ServerName yourdomain.com
       ServerAlias www.yourdomain.com
       DocumentRoot /var/www/html/phpcasino-2222-casino
       
       <Directory /var/www/html/phpcasino-2222-casino>
           Options -Indexes +FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/casino-error.log
       CustomLog ${APACHE_LOG_DIR}/casino-access.log combined
   </VirtualHost>
   ```

3. **Enable site**
   ```bash
   sudo a2ensite casino.conf
   sudo systemctl reload apache2
   ```

### Nginx Configuration

Create `/etc/nginx/sites-available/casino`:
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/html/phpcasino-2222-casino;
    index index.php index.html;

    access_log /var/log/nginx/casino-access.log;
    error_log /var/log/nginx/casino-error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/casino /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

## 🔒 SSL/HTTPS Setup (Recommended)

### Using Let's Encrypt (Free SSL)

1. **Install Certbot**
   ```bash
   sudo apt update
   sudo apt install certbot python3-certbot-apache
   # or for Nginx
   sudo apt install certbot python3-certbot-nginx
   ```

2. **Obtain SSL certificate**
   ```bash
   # For Apache
   sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
   
   # For Nginx
   sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
   ```

3. **Auto-renewal**
   ```bash
   sudo certbot renew --dry-run
   ```

## ⚙️ Configuration Customization

Edit `includes/config.php` to customize company details:

```php
// Company Information
define('COMPANY_NAME', 'Your Company Name');
define('COMPANY_CIN', 'Your CIN Number');
define('COMPANY_GST', 'Your GST Number');
define('COMPANY_PAN', 'Your PAN Number');
define('COMPANY_ADDRESS', 'Your Complete Address');
define('COMPANY_EMAIL', 'your-email@domain.com');

// Game Settings
define('INITIAL_BALANCE', 10000);  // Starting balance
define('MIN_BET', 200);            // Minimum bet amount
define('MAX_BET', 5500);           // Maximum bet amount
```

## 🔍 Testing Deployment

1. **Test homepage**
   - Navigate to `https://yourdomain.com`
   - Verify balance shows ₹10,000

2. **Test all games**
   - Click each game and verify it loads
   - Place a bet and verify balance updates
   - Test cashout functionality

3. **Test pages**
   - About Us: `/pages/about.php`
   - Games: `/pages/games.php`
   - Terms: `/pages/terms.php`
   - Privacy: `/pages/privacy.php`

4. **Test responsive design**
   - Open on mobile device
   - Test all games on mobile
   - Verify navigation works

5. **Test API endpoints**
   ```bash
   curl https://yourdomain.com/api/get-balance.php
   curl -X POST https://yourdomain.com/api/reset-balance.php
   ```

## 🐛 Troubleshooting

### Issue: PHP not working

**Solution:**
```bash
# Check PHP version
php -v

# Check PHP-FPM status
sudo systemctl status php7.4-fpm

# Restart PHP-FPM
sudo systemctl restart php7.4-fpm
```

### Issue: .htaccess not working

**Solution:**
```bash
# Enable mod_rewrite
sudo a2enmod rewrite

# Check AllowOverride in Apache config
# Should be: AllowOverride All

# Restart Apache
sudo systemctl restart apache2
```

### Issue: Permission denied errors

**Solution:**
```bash
# Set correct ownership
sudo chown -R www-data:www-data /path/to/casino

# Set correct permissions
sudo chmod -R 755 /path/to/casino
sudo chmod -R 644 /path/to/casino/*.php
```

### Issue: Games not loading

**Solution:**
- Check browser console for JavaScript errors
- Verify all CSS/JS files are loading
- Clear browser cache
- Check file permissions

## 📊 Performance Optimization

### Enable Gzip Compression
Already configured in `.htaccess` for Apache.

For Nginx, add to server block:
```nginx
gzip on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml;
gzip_min_length 1000;
```

### Enable Browser Caching
Already configured in `.htaccess` for Apache.

### PHP Optimization
Edit `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
```

## 🔐 Security Checklist

- ✅ SSL/HTTPS enabled
- ✅ PHP display_errors = Off in production
- ✅ Directory browsing disabled
- ✅ .htaccess protecting sensitive files
- ✅ Security headers configured
- ✅ Regular backups scheduled
- ✅ Server firewall configured
- ✅ PHP version up to date

## 📱 CDN Setup (Optional)

For better performance, use a CDN like Cloudflare:

1. Sign up at cloudflare.com
2. Add your domain
3. Update nameservers
4. Enable caching and optimization
5. Enable SSL/TLS

## 🔄 Updating the Website

### Using Git
```bash
cd /path/to/phpcasino-2222-casino
git pull origin master
sudo systemctl reload apache2  # or nginx
```

### Manual Update
1. Download latest version from GitHub
2. Backup current files
3. Upload new files via FTP
4. Clear browser cache

## 📞 Support

For deployment issues or questions:
- GitHub: https://github.com/Krishnaait/phpcasino-2222-casino
- Email: support@casinoprivate.com

## 📝 Post-Deployment Checklist

- [ ] Website accessible via domain
- [ ] SSL certificate installed and working
- [ ] All 8 games load and function correctly
- [ ] Balance system works (add/subtract/reset)
- [ ] All pages load (About, Games, Terms, Privacy)
- [ ] Mobile responsive design verified
- [ ] Browser compatibility tested
- [ ] Performance optimized
- [ ] Security headers configured
- [ ] Backup system in place
- [ ] Error logging configured
- [ ] Analytics setup (if needed)

---

**Deployment completed successfully! 🎉**

Your casino website is now live and ready for players!
