<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

$response = [
    'success' => true,
    'balance' => getBalance(),
    'currency' => CURRENCY,
    'formatted' => formatCurrency(getBalance())
];

echo json_encode($response);
?>
