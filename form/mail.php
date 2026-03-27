<?php
/**
 * Contact Form Mailer
 * Portfolio: princethawani.com
 * Receives form submissions and forwards to info@princethawani.com
 */

// ── CONFIGURATION ──────────────────────────────────────────
$to_email    = 'info@princethawani.com';       // Where messages are delivered
$from_email  = 'noreply@princethawani.com';    // Must be a cPanel email on your domain
$site_name   = 'Prince Thawani Portfolio';
// ───────────────────────────────────────────────────────────

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit;
}

// ── SANITIZE INPUTS ────────────────────────────────────────
function clean($value) {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

$name    = isset($_POST['name'])    ? clean($_POST['name'])    : '';
$email   = isset($_POST['email'])   ? clean($_POST['email'])   : '';
$subject = isset($_POST['subject']) ? clean($_POST['subject']) : '';
$message = isset($_POST['message']) ? clean($_POST['message']) : '';

// ── VALIDATION ─────────────────────────────────────────────
$errors = [];

if (empty($name))    $errors[] = 'Name is required.';
if (empty($email))   $errors[] = 'Email is required.';
if (empty($subject)) $errors[] = 'Subject is required.';
if (empty($message)) $errors[] = 'Message is required.';

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

if (strlen($name) > 100)     $errors[] = 'Name is too long.';
if (strlen($subject) > 200)  $errors[] = 'Subject is too long.';
if (strlen($message) > 5000) $errors[] = 'Message is too long (max 5000 chars).';

// Basic honeypot spam check (add hidden input name="honeypot" to your form)
if (!empty($_POST['honeypot'])) {
    http_response_code(200);
    echo json_encode(['status' => 'success', 'message' => 'Message sent!']);
    exit;
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ── BUILD EMAIL ────────────────────────────────────────────
$mail_subject = "[{$site_name}] {$subject}";

$mail_body = "
You have received a new message from your portfolio contact form.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  SENDER DETAILS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  Name    : {$name}
  Email   : {$email}
  Subject : {$subject}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  MESSAGE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
{$message}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  Sent via : {$site_name}
  Time     : " . date('Y-m-d H:i:s T') . "
  IP       : " . $_SERVER['REMOTE_ADDR'] . "
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
";

// ── EMAIL HEADERS ──────────────────────────────────────────
$headers  = "From: {$site_name} <{$from_email}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ── SEND MAIN EMAIL ────────────────────────────────────────
$sent = mail($to_email, $mail_subject, $mail_body, $headers);

if ($sent) {

    // ── AUTO-REPLY TO SENDER ───────────────────────────────
    $reply_subject = "Thanks for reaching out, {$name}!";

    $reply_body = "
Hi {$name},

Thank you for getting in touch! I have received your message and will
get back to you as soon as possible — usually within 24 to 48 hours.

Here is a copy of what you sent:
────────────────────────────────
Subject : {$subject}
Message : {$message}
────────────────────────────────

Best regards,
Prince Thawani
Backend & Full-Stack Developer
www.princethawani.com
+265 991 682 966
";

    $reply_headers  = "From: {$site_name} <{$from_email}>\r\n";
    $reply_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $reply_headers .= "MIME-Version: 1.0\r\n";
    $reply_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($email, $reply_subject, $reply_body, $reply_headers);

    http_response_code(200);
    echo json_encode([
        'status'  => 'success',
        'message' => 'Your message has been sent successfully. Thank you!'
    ]);

} else {

    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Failed to send your message. Please try again or email me directly at info@princethawani.com'
    ]);

}
?>