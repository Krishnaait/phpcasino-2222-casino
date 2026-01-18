# 🎰 Casino PRIVATE LIMITED - Free-to-Play Casino Website

A complete, fully functional casino website with 8 unique games built with HTML, CSS, PHP, and JavaScript. 100% free-to-play with no login or registration required.

## 🎮 Features

- **8 Unique Games** - Dice, Mines, Chicken, Plinko, Lucky Spin, Guess the Number, Shooting, Racing
- **No Login Required** - Start playing instantly with ₹10,000 virtual balance
- **Session-Based** - All data stored locally in browser
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Modern UI/UX** - Dark casino theme with smooth animations
- **Credit System** - Bet between ₹200-₹5,500 per game
- **Real-time Balance** - Live balance updates across all games
- **Legal Pages** - Terms & Conditions, Privacy Policy, About Us

## 🎲 Games Included

### 1. Dice Game 🎲
Predict if two dice will roll HIGH (8-12) or LOW (2-6). Win 2x your bet!

### 2. Mines 💎
Reveal tiles without hitting mines. Progressive multipliers up to 5x. Cashout anytime!

### 3. Chicken 🐔
Navigate obstacles and collect eggs. Skill-based gameplay with live cashout.

### 4. Plinko 🎯
Drop balls through pegs to land in multiplier slots. Multiple balls at once!

### 5. Lucky Spin 🎡
Spin the wheel to win multipliers from 1x to 5x. Beautiful wheel animation!

### 6. Guess the Number 🔮
Pick a number between 1-7. Guess correctly to win 7x your bet!

### 7. Shooting 🎯
Click targets within 30 seconds. Each hit increases multiplier by 0.1x!

### 8. Racing 🏎️
Race against the clock. Faster finishes = higher multipliers. Use arrow keys and space!

## 🚀 Installation

### Requirements
- PHP 7.4 or higher
- Web server (Apache/Nginx)
- Modern web browser

### Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/Krishnaait/phpcasino-2222-casino.git
cd phpcasino-2222-casino
```

2. **Configure web server**

For Apache, point document root to the project folder:
```apache
<VirtualHost *:80>
    DocumentRoot "/path/to/phpcasino-2222-casino"
    ServerName casino.local
    <Directory "/path/to/phpcasino-2222-casino">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

For Nginx:
```nginx
server {
    listen 80;
    server_name casino.local;
    root /path/to/phpcasino-2222-casino;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

3. **Start the server**
```bash
# Using PHP built-in server (for development)
php -S localhost:8000

# Or use your web server
sudo systemctl start apache2
# or
sudo systemctl start nginx
```

4. **Access the website**
Open your browser and navigate to:
- `http://localhost:8000` (PHP built-in server)
- `http://casino.local` (Apache/Nginx)

## 📁 Project Structure

```
phpcasino-2222-casino/
├── api/
│   ├── get-balance.php      # Get current balance
│   ├── update-balance.php   # Update balance (add/subtract)
│   └── reset-balance.php    # Reset balance to default
├── assets/
│   └── css/
│       ├── global.css       # Main stylesheet
│       └── responsive.css   # Mobile responsive styles
├── games/
│   ├── chicken.php          # Chicken game
│   ├── dice.php             # Dice game
│   ├── guess-the-no.php     # Guess the number game
│   ├── lucky-spin.php       # Lucky spin game
│   ├── mines.php            # Mines game
│   ├── plinko.php           # Plinko game
│   ├── racing.php           # Racing game
│   └── shooting.php         # Shooting game
├── includes/
│   ├── config.php           # Configuration & constants
│   ├── header.php           # Global header
│   └── footer.php           # Global footer
├── pages/
│   ├── about.php            # About us page
│   ├── games.php            # Games listing page
│   ├── privacy.php          # Privacy policy
│   └── terms.php            # Terms & conditions
├── index.php                # Homepage
└── README.md                # This file
```

## 🎨 Design Features

- **Dark Casino Theme** - Professional purple/gold color scheme
- **Smooth Animations** - CSS transitions and keyframe animations
- **Canvas Games** - HTML5 Canvas for Plinko, Shooting, Racing
- **Responsive Layout** - Mobile-first design approach
- **Modern UI Components** - Cards, gradients, glassmorphism effects

## 🔧 Configuration

Edit `includes/config.php` to customize:

```php
// Company Information
define('COMPANY_NAME', 'Casino PRIVATE LIMITED');
define('COMPANY_CIN', 'FEWFB78Y33742739FJFB');
define('COMPANY_GST', '8458BUHF844');
define('COMPANY_PAN', '0964327DFWE23');
define('COMPANY_ADDRESS', 'C/O MOIEIIEEO IEKEEN 20-P DSC, SEC-23A, Shivaji Nagar (Gurgaon), Shivaji Nagar, Gurgaon- 122001, Haryana');
define('COMPANY_EMAIL', 'support@casinoprivate.com');

// Game Settings
define('INITIAL_BALANCE', 10000);
define('MIN_BET', 200);
define('MAX_BET', 5500);
```

## 💰 Credit System

- **Initial Balance**: ₹10,000 (virtual currency)
- **Bet Range**: ₹200 - ₹5,500 per game
- **Balance Storage**: Browser session/local storage
- **Reset**: Clear browser data or click "Reset Balance"

## 🔒 Privacy & Security

- **No Registration** - Zero personal data collection
- **No Database** - All data stored in browser
- **Session-Based** - Data cleared when browser closes
- **No Tracking** - No analytics or user monitoring
- **100% Free** - No real money involved

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Opera 76+

## 🎯 Game Mechanics

All games use:
- **Random Number Generation** - Fair and unpredictable outcomes
- **Real-time Balance Updates** - Instant credit/debit
- **Multiplier System** - Various win multipliers per game
- **Responsive Controls** - Keyboard and mouse support

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.4+
- **Graphics**: HTML5 Canvas API
- **Storage**: Browser LocalStorage & SessionStorage
- **Architecture**: Session-based, no database required

## 📄 Legal Compliance

- Terms & Conditions included
- Privacy Policy included
- Company information displayed
- GST/CIN/PAN details provided
- Disclaimer for entertainment purposes

## 🤝 Contributing

This is a private project. For issues or suggestions, please contact the repository owner.

## 📧 Contact

**Casino PRIVATE LIMITED**
- Email: support@casinoprivate.com
- Address: C/O MOIEIIEEO IEKEEN 20-P DSC, SEC-23A, Shivaji Nagar (Gurgaon), Shivaji Nagar, Gurgaon- 122001, Haryana
- CIN: FEWFB78Y33742739FJFB
- GST: 8458BUHF844
- PAN: 0964327DFWE23

## ⚠️ Disclaimer

This platform is for **entertainment purposes only**. All games use **virtual currency with zero real-world value**. No real money gambling is conducted on this platform. This is not a real casino and does not involve any monetary transactions.

## 📜 License

Copyright © 2025 Casino PRIVATE LIMITED. All rights reserved.

---

**Built with ❤️ for entertainment purposes only**

🎰 **Start Playing Now!** - No login, no registration, just pure fun!
