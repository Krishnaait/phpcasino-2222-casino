<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . COMPANY_NAME : COMPANY_NAME; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Global Styles -->
    <link rel="stylesheet" href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : ''; ?>assets/css/global.css">
    <link rel="stylesheet" href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : ''; ?>assets/css/responsive.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Primary Colors */
            --primary-color: #ff6b35;
            --primary-dark: #d94d1f;
            --primary-light: #ff8a5b;
            
            /* Secondary Colors */
            --secondary-color: #004e89;
            --secondary-dark: #003d6b;
            --secondary-light: #1a6fb0;
            
            /* Accent Colors */
            --accent-gold: #ffd700;
            --accent-purple: #9d4edd;
            --accent-cyan: #00d9ff;
            --accent-green: #00ff00;
            --accent-red: #ff4444;
            
            /* Neutral Colors */
            --dark-bg: #0a0e27;
            --darker-bg: #050812;
            --light-text: #ffffff;
            --gray-text: #b0b0b0;
            --border-color: #1a1f3a;
            
            /* Spacing */
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 16px;
            --spacing-lg: 24px;
            --spacing-xl: 32px;
            --spacing-2xl: 48px;
            
            /* Border Radius */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-2xl: 24px;
            
            /* Shadows */
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.5);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);
            color: var(--light-text);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navigation Header */
        .navbar {
            background: rgba(5, 8, 18, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--border-color);
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-gold), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand i {
            font-size: 2rem;
            color: var(--accent-gold);
        }

        .navbar-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            flex: 1;
        }

        .navbar-menu a {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .navbar-menu a:hover {
            color: var(--accent-gold);
        }

        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-gold);
            transition: width 0.3s ease;
        }

        .navbar-menu a:hover::after {
            width: 100%;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .balance-display {
            background: rgba(255, 215, 0, 0.1);
            border: 2px solid var(--accent-gold);
            padding: 10px 20px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--accent-gold);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
        }

        .balance-display i {
            font-size: 1.3rem;
        }

        .reset-btn {
            background: linear-gradient(135deg, var(--accent-green), #00cc00);
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-lg);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 255, 0, 0.3);
        }

        .reset-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 0, 0.4);
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
            min-height: calc(100vh - 80px);
        }

        /* Footer */
        .footer {
            background: rgba(5, 8, 18, 0.95);
            border-top: 2px solid var(--border-color);
            padding: 40px 30px;
            margin-top: 60px;
            color: var(--gray-text);
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            color: var(--accent-gold);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: var(--gray-text);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--accent-gold);
        }

        .footer-bottom {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
            text-align: center;
        }

        .legal-disclaimer {
            background: rgba(255, 215, 0, 0.05);
            border: 1px solid rgba(255, 215, 0, 0.2);
            padding: 15px;
            border-radius: var(--radius-lg);
            margin-bottom: 15px;
            font-size: 0.85rem;
        }

        .age-badge {
            display: inline-block;
            background: var(--accent-red);
            color: white;
            padding: 5px 10px;
            border-radius: var(--radius-md);
            font-weight: 700;
            margin-right: 10px;
            font-size: 0.8rem;
        }

        /* Notification Toast */
        .toast {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 15px 20px;
            border-radius: var(--radius-lg);
            color: white;
            font-weight: 600;
            z-index: 2000;
            animation: slideIn 0.3s ease;
            max-width: 400px;
        }

        .toast.success {
            background: linear-gradient(135deg, var(--accent-green), #00cc00);
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.3);
        }

        .toast.error {
            background: linear-gradient(135deg, var(--accent-red), #cc0000);
            box-shadow: 0 0 20px rgba(255, 68, 68, 0.3);
        }

        .toast.warning {
            background: linear-gradient(135deg, #ffa500, #ff8800);
            box-shadow: 0 0 20px rgba(255, 165, 0, 0.3);
        }

        .toast.info {
            background: linear-gradient(135deg, var(--secondary-light), var(--secondary-color));
            box-shadow: 0 0 20px rgba(26, 111, 176, 0.3);
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-gold), #ffed4e);
            color: #000;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-light), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 15px rgba(26, 111, 176, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 111, 176, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }

            .navbar-container {
                gap: 15px;
            }

            .main-container {
                padding: 15px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : ''; ?>index.php" class="navbar-brand">
                <i class="fas fa-dice"></i>
                CASINO
            </a>

            <ul class="navbar-menu">
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : ''; ?>index.php">Home</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../pages/' : 'pages/'; ?>games.php">Games</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../pages/' : 'pages/'; ?>about.php">About</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], '/games/') !== false || strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../pages/' : 'pages/'; ?>contact.php">Contact</a></li>
            </ul>

            <div class="navbar-right">
                <div class="balance-display">
                    <i class="fas fa-coins"></i>
                    <span id="balanceDisplay"><?php echo formatCurrency(getBalance()); ?></span>
                </div>
                <button class="reset-btn" onclick="resetBalance()">Reset</button>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="main-container">
