<?php
/**
 * Casino PRIVATE LIMITED - Configuration File
 * CIN: FEWFB78Y33742739FJFB
 * GST: 8458BUHF844
 * PAN: 0964327DFWE23
 */

session_start();

// ==================== COMPANY INFORMATION ====================
define('COMPANY_NAME', 'Casino PRIVATE LIMITED');
define('COMPANY_CIN', 'FEWFB78Y33742739FJFB');
define('COMPANY_GST', '8458BUHF844');
define('COMPANY_PAN', '0964327DFWE23');
define('COMPANY_ADDRESS', 'C/O MOIEIIEEO IEKEEN 20-P DSC, SEC-23A, Shivaji Nagar (Gurgaon), Shivaji Nagar, Gurgaon- 122001, Haryana');
define('COMPANY_EMAIL', 'contact@casinoprivate.com');

// ==================== BALANCE & BETTING CONFIGURATION ====================
define('INITIAL_BALANCE', 10000);      // ₹10,000 starting balance
define('MIN_BET', 200);                // ₹200 minimum bet
define('MAX_BET', 5500);               // ₹5,500 maximum bet
define('CURRENCY', '₹');               // Indian Rupee

// ==================== SESSION CONFIGURATION ====================
define('SESSION_TIMEOUT', 3600);       // 1 hour session timeout
define('SESSION_NAME', 'casino_session');

// ==================== GAME CONFIGURATION ====================
define('GAME_TIMEOUT', 300);           // 5 minutes per game session
define('MAX_GAME_HISTORY', 50);        // Store last 50 games

// ==================== INITIALIZE USER SESSION ====================
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = uniqid('player_', true);
    $_SESSION['balance'] = INITIAL_BALANCE;
    $_SESSION['session_start'] = time();
    $_SESSION['game_history'] = [];
    $_SESSION['total_wins'] = 0;
    $_SESSION['total_losses'] = 0;
    $_SESSION['games_played'] = 0;
}

// ==================== SESSION TIMEOUT CHECK ====================
if (isset($_SESSION['session_start'])) {
    if (time() - $_SESSION['session_start'] > SESSION_TIMEOUT) {
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// ==================== HELPER FUNCTIONS ====================

/**
 * Get current user balance
 */
function getBalance() {
    return isset($_SESSION['balance']) ? $_SESSION['balance'] : INITIAL_BALANCE;
}

/**
 * Update user balance
 */
function updateBalance($amount) {
    if (!isset($_SESSION['balance'])) {
        $_SESSION['balance'] = INITIAL_BALANCE;
    }
    $_SESSION['balance'] += $amount;
    return $_SESSION['balance'];
}

/**
 * Reset balance to initial amount
 */
function resetBalance() {
    $_SESSION['balance'] = INITIAL_BALANCE;
    return INITIAL_BALANCE;
}

/**
 * Validate bet amount
 */
function isValidBet($bet) {
    $bet = (float)$bet;
    return $bet >= MIN_BET && $bet <= MAX_BET && $bet <= getBalance();
}

/**
 * Format currency
 */
function formatCurrency($amount) {
    return CURRENCY . number_format($amount, 2, '.', ',');
}

/**
 * Record game result
 */
function recordGameResult($game_name, $bet, $result, $winnings) {
    if (!isset($_SESSION['game_history'])) {
        $_SESSION['game_history'] = [];
    }
    
    $record = [
        'game' => $game_name,
        'bet' => $bet,
        'result' => $result,
        'winnings' => $winnings,
        'timestamp' => date('Y-m-d H:i:s'),
        'balance_after' => getBalance()
    ];
    
    array_unshift($_SESSION['game_history'], $record);
    
    // Keep only last MAX_GAME_HISTORY records
    if (count($_SESSION['game_history']) > MAX_GAME_HISTORY) {
        array_pop($_SESSION['game_history']);
    }
    
    // Update statistics
    $_SESSION['games_played']++;
    if ($winnings > 0) {
        $_SESSION['total_wins']++;
    } else {
        $_SESSION['total_losses']++;
    }
}

/**
 * Get game history
 */
function getGameHistory() {
    return isset($_SESSION['game_history']) ? $_SESSION['game_history'] : [];
}

/**
 * Get game statistics
 */
function getGameStats() {
    return [
        'games_played' => isset($_SESSION['games_played']) ? $_SESSION['games_played'] : 0,
        'total_wins' => isset($_SESSION['total_wins']) ? $_SESSION['total_wins'] : 0,
        'total_losses' => isset($_SESSION['total_losses']) ? $_SESSION['total_losses'] : 0,
        'win_rate' => (isset($_SESSION['games_played']) && $_SESSION['games_played'] > 0) 
            ? round(($_SESSION['total_wins'] / $_SESSION['games_played']) * 100, 2) 
            : 0
    ];
}

?>
