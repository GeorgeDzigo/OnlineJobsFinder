<?php
require_once './vendor/autoload.php';
// This is your real test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51I7hxVKMxglRsCAQJ5aCXufb0DzCsK7VY3V5W8D4RQaKjI3Wdak970WeXaCxSokQiQhJoKS9l6IiZvg2MWOrNOiz00IW3Kz08E');
function calculateOrderAmount(array $items): int {
  // Replace this constant with a calculation of the order's amount
  // Calculate the order total on the server to prevent
  // customers from directly manipulating the amount on the client
  return 1400;
}
header('Content-Type: application/json');
try {
  // retrieve JSON from POST body
  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);
  $paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => calculateOrderAmount($json_obj->items),
    'currency' => 'usd',
  ]);
  $output = [
    'clientSecret' => $paymentIntent->client_secret,
  ];
  echo json_encode($output);
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}