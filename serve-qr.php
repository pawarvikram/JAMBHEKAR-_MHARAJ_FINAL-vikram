<?php
session_start();

// ✅ Optionally check session or token here
// if (!isset($_SESSION['user'])) { http_response_code(403); exit('Forbidden'); }

// ✅ Restrict referrers (anti-hotlinking)
// ✅ Restrict direct image access via referer
$allowed_referer = 'https://jambhekarmaharaj.org';
$referer = $_SERVER['HTTP_REFERER'] ?? '';

if (empty($referer) || strpos($referer, $allowed_referer) !== 0) {
    http_response_code(403);
    exit('Access Denied: Invalid referer');
}

// ✅ Set secure headers
header('Content-Type: image/jpeg');
header('Content-Disposition: inline; filename="qr.jpeg"');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Cache-Control: no-store');



$imagePath = '/home3/a1752fou/cpaneluser/qr.jpeg'; // ✅ Replace with correct absolute path
if (!file_exists($imagePath)) {
    http_response_code(404);
    exit('QR Code not found.');
}

readfile($imagePath);
exit;
?>
