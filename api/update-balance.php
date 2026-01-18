<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['amount'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Amount not provided'
    ]);
    exit;
}

$amount = (float)$data['amount'];
$new_balance = updateBalance($amount);

// Check if balance is zero
if ($new_balance <= 0) {
    $_SESSION['balance'] = 0;
    echo json_encode([
        'success' => true,
        'balance' => 0,
        'zero_balance' => true,
        'message' => 'Your balance is zero. Click Reset to play again.'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'balance' => $new_balance,
    'formatted' => formatCurrency($new_balance),
    'zero_balance' => false
]);
?>
