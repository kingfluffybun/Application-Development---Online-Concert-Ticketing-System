<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <section class="ticket-form-section">
    <form class="ticket-form" action="">
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
    </form>
    </section>
<script src="../util/payment.js"></script>
</body>
</html>