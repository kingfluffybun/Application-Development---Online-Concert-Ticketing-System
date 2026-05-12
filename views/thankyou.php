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
    <script src="../util/payment.js"></script>
</body>

</html>