<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login-register/login.php");
    exit();
}

// All seat data comes from session (set by seats.php after sending OTP)
$zone     = $_SESSION['otp_zone']    ?? '';
$section  = $_SESSION['otp_section'] ?? '';
$quantity = (int)($_SESSION['otp_qty'] ?? 1);
$user_id  = $_SESSION['user_id'];

if (empty($zone) || empty($section)) {
    header("Location: seats.php?error=seat");
    exit();
}

$zonePrices = [
    'VIP'       => 19500,
    'Lower Box' => 14000,
    'Upper Box' => 9000,
    'Gen Adm'   => 3000,
];
$basePrice  = $zonePrices[$zone] ?? 0;
$totalPrice = $basePrice * $quantity;

// OTP verification on form submit
$otp_error   = '';
$otp_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered = trim($_POST['transac_no'] ?? '');
    $stored  = $_SESSION['otp_code'] ?? '';

    if ($entered === '' || strlen($entered) !== 8) {
        $otp_error = 'Please enter the complete 8-digit code.';
    } elseif ($entered !== $stored) {
        $otp_error = 'Incorrect code. Please check your email and try again.';
    } else {
        // Code matches – clear OTP from session and forward to thankyou.php
        unset($_SESSION['otp_code']);
        $otp_success = true;
        // Pass data forward via POST using a self-submitting form (see below)
    }
}

// Was the email sent successfully?
$mail_failed = isset($_SESSION['otp_sent']) && $_SESSION['otp_sent'] === false;
$mail_error  = $_SESSION['mail_error'] ?? '';
$otp_email   = $_SESSION['otp_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>Payment – BLACKPINK Ticketing</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
<?php if ($otp_success): ?>
<!-- Auto-submit to thankyou.php when OTP is correct -->
<form id="forward-form" action="thankyou.php" method="post" style="display:none;">
    <input type="hidden" name="user_id"  value="<?= htmlspecialchars($user_id) ?>">
    <input type="hidden" name="zone"     value="<?= htmlspecialchars($zone) ?>">
    <input type="hidden" name="section"  value="<?= htmlspecialchars($section) ?>">
    <input type="hidden" name="quantity" value="<?= htmlspecialchars($quantity) ?>">
    <input type="hidden" name="transac_no" value="<?= htmlspecialchars($_POST['transac_no']) ?>">
</form>
<script>document.getElementById('forward-form').submit();</script>
<?php endif; ?>
    <section class="ticket-form-section">
    <a href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left"><path d="M6 8L2 12L6 16"/><path d="M2 12H22"/></svg>
        <p>Back to Home</p>
    </a>
    <form class="ticket-form" action="payment.php" method="post">
        <div style="grid-column: span 2; display: flex; justify-content: space-between; align-items: flex-start;">
            <h1 class="select-seat-header">Payment</h1>
            <div style="display: flex; gap: 8px; align-items: center; padding: 12px;">
                <a href="seats.php" class="step active">
                    <div class="step-number"><p>1</p></div>
                    <p>Select Seat</p>
                </a>
                <div class="step active">
                    <div class="step-number"><p>2</p></div>
                    <p>Payment</p>
                </div>
                <div class="step">
                    <div class="step-number"><p>3</p></div>
                    <p>Thank You!</p>
                </div>
            </div>
        </div>
        <div class="payment">
            <div class="payment-header">
                <div>
                    <p>Total Amount To Pay</p>
                    <h2>₱<?php echo number_format($totalPrice); ?></h2>
                </div>
                <div style="text-align: right;">
                    <p><?php echo htmlspecialchars($zone); ?> · Section <?php echo htmlspecialchars($section); ?></p>
                    <p><?= $quantity . ' Ticket' . ($quantity == 1 ? '' : 's'); ?> · August 15, 2026</p>
                </div>
            </div>
            <div style="padding-bottom: 24px;">
                <div style="display: flex; gap: 8px; flex-direction: column;">
                    <h2>Transaction Number</h2>
                    <?php if ($mail_failed): ?>
                    <p style="color:#ff6b6b; background:rgba(255,107,107,0.1); border:1px solid rgba(255,107,107,0.3); border-radius:8px; padding:10px 14px; margin:0;">
                        ⚠️ We couldn't send the email (<?= htmlspecialchars($mail_error) ?>). Please contact support.
                    </p>
                    <?php else: ?>
                    <p>A code was sent to <strong><?= htmlspecialchars($otp_email) ?></strong>. Enter it below to verify.</p>
                    <?php endif; ?>
                </div>
                <br>
                <div class="transaction-number-container">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <div class="transaction-number-input-separator"></div>
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input" autocomplete="off">
                </div>
                <input type="hidden" name="transac_no" id="hidden-transac_no">
                <?php if ($otp_error): ?>
                <p style="color:#ff6b6b; margin-top:12px; font-size:14px;">❌ <?= htmlspecialchars($otp_error) ?></p>
                <?php endif; ?>
            </div>
            <h2>How to Pay?</h2>
            <div class="how-to-pay">
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>1</h2></div>
                    <p>Check your email for the 8-digit transaction reference number sent to you.</p>
                </div>
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>2</h2></div>
                    <p>Enter the 8-digit code in the transaction number field above to verify your payment.</p>
                </div>
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>3</h2></div>
                    <p>Click Confirm Payment to complete your ticket purchase once the code is entered.</p>
                </div>
            </div>
        </div>
        <div class="seat-summary">
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="order-summary-info">
                    <div>
                        <p>Zone</p>
                        <div class="zone-pill" id="zone-pill" style="display: <?php echo $zone ? 'block' : 'none'; ?>;"><p><?php echo htmlspecialchars($zone); ?></p></div>
                    </div>
                    <div>
                        <p>Section</p>
                        <p><?php echo htmlspecialchars($section); ?></p>
                    </div>
                    <div>
                        <p>Price</p>
                        <p>₱<?php echo number_format($basePrice); ?></p>
                    </div>
                    <div>
                        <p>Quantity</p>
                        <p><?= $quantity . ' Ticket' . ($quantity == 1 ? '' : 's'); ?></p>
                    </div>
                </div>
                <!-- <hr style="margin: 12px 0;"> -->
                <div style="display: flex; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.15); margin-top: 8px; padding-top: 12px;" >
                    <h2>Total</h2>
                    <h2 id="total-price" style="font-size: 48px; color: var(--vip);">₱<?php echo number_format($totalPrice); ?></h2>
                </div>
            </div>
            <div class="order-summary">
                <h2>Event Details</h2>
                <div class="order-summary-info">
                    <div>
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar1-icon lucide-calendar-1"><path d="M11 14h1v4"/><path d="M16 2v4"/><path d="M3 10h18"/><path d="M8 2v4"/><rect x="3" y="4" width="18" height="18" rx="2"/></svg>
                            <p>Date</p>
                        </div>
                        <p>August 15, 2026</p>
                    </div>
                    <div>
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                            <p>Venue</p>
                        </div>
                        <p>Smart Araneta Coliseum, Quezon City</p>
                    </div>
                    <div>
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock6-icon lucide-clock-6"><circle cx="12" cy="12" r="10"/><path d="M12 6v10"/></svg>
                            <p>Doors Open</p>
                        </div>
                        <p>6:00 PM</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="proceed" id="confirm-btn"><h1>Confirm Payment</h1></button>
        </div>
    </form>
    </section>
    <footer>
        <div class="footer-content">
            <div class="footer-column" style="gap: 24px;">
                <img src="/assets/images/Logo_of_Blackpink.svg.png" width="80%" height="auto"> 
                <p>Born Pink World Tour 2026 · Experience the most iconic K-pop girl group live at Smart Araneta Coliseum, Quezon City.</p>
                <div class="socials"> 
                    <a href="https://www.facebook.com/BLACKPINKOFFICIAL" target="_blank"><div class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></div></a>
                    <a href="https://www.instagram.com/blackpinkofficial/" target="_blank"><div class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></div></a>
                    <a href="https://x.com/BLACKPINK" target="_blank"><div class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter-icon lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></div></a>
                    <a href="https://www.youtube.com/@BLACKPINK" target="_blank"><div class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-youtube-icon lucide-youtube"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg></div></a>
                </div>
            </div>
            <div class="footer-column">
                <p class="footer-header">TICKETS</p>
                <div>
                    <p>VIP — ₱19,500</p>
                    <p>Lower Box — ₱14,000</p>
                    <p>Upper Box — ₱9,000</p>
                    <p>General Admission — ₱3,000</p>
                </div>
            </div>
            <div class="footer-column">
                <p class="footer-header">NAVIGATE</p>
                <div>
                    <a href="/views/index.php#home"><p>Home</p></a>
                    <a href="/views/index.php#ticket"><p>Tickets</p></a>
                    <a href="/views/index.php#members"><p>Members</p></a>
                    <a href="/views/index.php#faq"><p>FAQ</p></a>
                </div>
            </div>
            <div class="footer-column">
                <p class="footer-header">ACCOUNT</p>
                <div>
                    <a href="/views/login-register/login.php"><p>Login</p></a>
                    <a href="/views/login-register/register.php"><p>Register</p></a>
                    <a href="/views/profile/profile.php"><p>View Tickets</p></a>
                    <a href="/views/profile/profile.php"><p>Manage Profile</p></a>
                </div>
            </div>
            <div class="footer-column">
                <p class="footer-header">MADE WITH ❤ by</p>
                <div>
                    <p>Clarence Jerald G. Luna</p>
                    <p>Kevenly H. Luistro</p>
                    <p>Jhon Rick S. Parica</p>
                    <p>Christian Patrick T. Panti</p>
                    <p>Vien J. Cabillos</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 BLACKPINK In Your Area. All rights reserved.</p>
            <p>Smart Araneta Coliseum, Quezon City · August 15, 2026 · 6:00 PM</p>
        </div>
    </footer>
<script src="/util/payment.js"></script>
</body>
</html>