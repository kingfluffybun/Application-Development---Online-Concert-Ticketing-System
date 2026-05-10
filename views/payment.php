<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login-register/login.php");
    exit();
}

$zone = $_POST['zone'] ?? '';
$section = $_POST['section'] ?? '';
$quantity = (int)($_POST['quantity'] ?? 1);
$user_id = $_SESSION['user_id'] ?? '';

$zonePrices = [
    'VIP' => 8500,
    'Lower Box' => 5500,
    'Upper Box' => 3500,
    'Gen Adm' => 1500,
];
$basePrice = $zonePrices[$zone] ?? 0;
$totalPrice = $basePrice * $quantity;
?>
    <section class="ticket-form-section">
    <a href="../index.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left"><path d="M6 8L2 12L6 16"/><path d="M2 12H22"/></svg>
        <p>Back to Home</p>
    </a>
    <form class="ticket-form" action="thankyou.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
        <input type="hidden" name="zone" value="<?php echo htmlspecialchars($zone); ?>">
        <input type="hidden" name="section" value="<?php echo htmlspecialchars($section); ?>">
        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
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
                    <p><?php echo htmlspecialchars($quantity); ?> tickets · August 15, 2026</p>
                </div>
            </div>
            <div style="padding-bottom: 24px;">
                <div style="display: flex; gap: 8px; flex-direction: column;">
                    <h2>Transaction Number</h2>
                    <p>Enter the 8-digit reference number from your payment center receipt.</p>
                </div>
                <br>
                <div class="transaction-number-container">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <div class="transaction-number-input-separator"></div>
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                    <input type="text" maxlength="1" inputmode="numeric" class="transaction-number-input">
                </div>
                <input type="hidden" name="transac_no" id="hidden-transac_no">
            </div>
            <h2>How to Pay?</h2>
            <div class="how-to-pay">
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>1</h2></div>
                    <p>Go to any accredited payment center near you (7-Eleven, Bayad Center, LBC, M Lhuillier, or Palawan Pawnshop) and pay the exact total amount.</p>
                </div>
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>2</h2></div>
                    <p>The cashier will provide you with an official receipt containing your 8-digit transaction reference number. You will need it to confirm your booking.</p>
                </div>
                <div class="pay-step-container">
                    <div class="pay-step-icon"><h2>3</h2></div>
                    <p>Come back to this page and enter your 8-digit transaction number in the field above. Click Confirm Payment to complete your ticket purchase.</p>
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
                        <p><?php echo htmlspecialchars($quantity); ?></p>
                    </div>
                </div>
                <!-- <hr style="margin: 12px 0;"> -->
                <div style="display: flex; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.15); margin-top: 8px; padding-top: 12px;" >
                    <h2>Total</h2>
                    <h2 id="total-price" style="font-size: 48px;">₱<?php echo number_format($totalPrice); ?></h2>
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
<script src="../util/payment.js"></script>
</body>
</html>