<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>

<body>
    <?php
    session_start();
    include '../db/db.php';

    $ticket = null;
    $formattedDate = date('F j, Y');
    $formattedTime = date('g:i A');
    $zoneDisplay = 'N/A';
    $sectionDisplay = 'N/A';
    $totalAmountDisplay = '0';
    $transacNoDisplay = '-';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
        $user_id = (int)$_POST['user_id'];
        $zone = $_POST['zone'] ?? '';
        $section = $_POST['section'] ?? '';
        $quantity = (int)($_POST['quantity'] ?? 0);
        $transac_no = $_POST['transac_no'] ?? '';

        if ($zone && $section && $quantity && $transac_no) {
            $zonePrices = [
                'VIP' => 19500,
                'Lower Box' => 14000,
                'Upper Box' => 9000,
                'Gen Adm' => 3000,
            ];
            $price = $zonePrices[$zone] * $quantity;

            $stmt = $conn->prepare("INSERT INTO tickets (user_id, zone, section, quantity, price, transac_no) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issids", $user_id, $zone, $section, $quantity, $price, $transac_no);
            if ($stmt->execute()) {
                $ticket_id = $conn->insert_id;
                $stmt->close();
                header('Location: thankyou.php?ticket_id=' . $ticket_id);
                exit;
            } else {
                echo "Error inserting ticket: " . $stmt->error;
                $stmt->close();
            }
        }
    }

    if (isset($_GET['ticket_id'])) {
        $ticket_id = (int)$_GET['ticket_id'];
        $stmt = $conn->prepare("SELECT zone, section, quantity, price, transac_no, created_at FROM tickets WHERE ticket_id = ?");
        $stmt->bind_param("i", $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ticket = $result->fetch_assoc();
        $stmt->close();
    }

    if ($ticket) {
        $zoneDisplay = htmlspecialchars($ticket['zone']);
        $sectionDisplay = htmlspecialchars($ticket['section']);
        $quantity = (int)$ticket['quantity'];
        $totalAmountDisplay = number_format($ticket['price']);
        $transacNoDisplay = htmlspecialchars($ticket['transac_no']);
        $createdAt = new DateTime($ticket['created_at']);
        $formattedDate = $createdAt->format('F j, Y');
        $formattedTime = $createdAt->format('g:i A');
    }
    ?>
    <section class="ticket-form-section" style="display: flex; flex-direction: column;">
        <a href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left">
                <path d="M6 8L2 12L6 16" />
                <path d="M2 12H22" />
            </svg>
            <p>Back to Home</p>
        </a>
        <div class="payment-success">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                <h1 class="select-seat-header">Thank You !</h1>
                <div style="display: flex; gap: 8px; align-items: center; padding: 12px;">
                    <a href="seats.php" class="step active">
                        <div class="step-number">
                            <p>1</p>
                        </div>
                        <p>Select Seat</p>
                    </a>
                    <div class="step active">
                        <div class="step-number">
                            <p>2</p>
                        </div>
                        <p>Payment</p>
                    </div>
                    <div class="step active">
                        <div class="step-number">
                            <p>3</p>
                        </div>
                        <p>Thank You!</p>
                    </div>
                </div>
            </div>
            <div class="payment-success-message">
                <div class="big-check">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                </div>
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <h2>Payment Successful</h2>
                    <p style="max-width: 400px; color: white; text-align: center; line-height: 1.5;">Your ticket is ready. Check your inbox or profile for event details. Enjoy the show!</p>
                </div>
                <div class="payment-details">
                    <h2 style="text-align: left; margin-bottom: 8px;">Order Details</h2>
                    <div class="payment-details-content">
                        <p>Buyer Name</p>
                        <p>Clarence Jerald Luna</p>
                    </div>
                    <div class="payment-details-content">
                        <p>Date</p>
                        <p><?php echo htmlspecialchars($formattedDate); ?></p>
                    </div>
                    <div class="payment-details-content">
                        <p>Time</p>
                        <p><?php echo htmlspecialchars($formattedTime); ?></p>
                    </div>
                    <div class="payment-details-content">
                        <p>Seat Zone</p>
                        <p><?php echo $zoneDisplay; ?></p>
                    </div>
                    <div class="payment-details-content">
                        <p>Section</p>
                        <p><?php echo $sectionDisplay; ?></p>
                    </div>
                    <div class="payment-details-content">
                        <p>Transaction Number</p>
                        <p>#<?php echo $transacNoDisplay; ?></p>
                    </div>
                    <div class="payment-details-content">
                        <p>Status</p>
                        <div style="color: #88E788;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                            <p style="color: currentColor;">Successful</p>
                        </div>
                    </div>
                    <div class="payment-details-content">
                        <p>Total Amount</p>
                        <p>₱<?php echo $totalAmountDisplay; ?></p>
                    </div>
                </div>
                <div class="payment-action">
                    <button class="proceed" style="gap: 8px; align-items: center;">
                        <h1>View Ticket</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg>
                    </button>
                    <a href="/views/" style="width: 100%; height: 100%;">
                        <div class="proceed">
                            <h1>Continue Exploring</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
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
                    <a href="#home"><p>Home</p></a>
                    <a href="#ticket"><p>Tickets</p></a>
                    <a href="#artist"><p>Members</p></a>
                    <a href="#faq"><p>FAQ</p></a>
                </div>
            </div>
            <div class="footer-column">
                <p class="footer-header">ACCOUNT</p>
                <div>
                    <a href="#home"><p>Login</p></a>
                    <a href="#ticket"><p>Register</p></a>
                    <a href="#artist"><p>View Tickets</p></a>
                    <a href="#faq"><p>Manage Profile</p></a>
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
    <script src="../util/payment.js"></script>
</body>

</html>