<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

$new_balance = resetBalance();

echo json_encode([
    'success' => true,
    'balance' => $new_balance,
    'formatted' => formatCurrency($new_balance),
    'message' => 'Balance reset to ' . formatCurrency($new_balance)
]);
?>
