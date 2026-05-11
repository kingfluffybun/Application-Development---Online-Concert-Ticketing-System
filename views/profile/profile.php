<?php
session_start();
include '../../db/db.php';

function getInitials($name)
{
  $words = explode(' ', $name);
  $initials = '';

  foreach ($words as $word) {
    $initials .= mb_strtoupper(mb_substr($word, 0, 1));
  }

  return $initials;
}

function getTicketCardClass($zone)
{
  $zone = strtolower(trim($zone));

  switch ($zone) {
    case 'gen admission':
      return 'ticket-card--gen-ad';
    case 'upper box':
      return 'ticket-card--upper-box';
    case 'lower box':
      return 'ticket-card--lower-box';
    case 'vip':
      return 'ticket-card--vip';
    default:
      return 'ticket-card';
  }
}

if (isset($_SESSION['user_name'])) {
  $check = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
  $check->bind_param("s", $_SESSION['user_name']);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['created_at'] = new DateTime($row['created_at']);
  } else {
    $_SESSION['user_email'] = "aaaaaa";
    $_SESSION['created_at'] = "Unknown";
  }
}

if (isset($_SESSION['user_id'])) {
  $checkTickets = $conn->prepare("SELECT SUM(quantity) AS total FROM tickets WHERE user_id = ?");
  $checkTickets->bind_param("i", $_SESSION['user_id']);
  $checkTickets->execute();
  $resultTickets = $checkTickets->get_result();

  if ($resultTickets->num_rows > 0) {
    $rowTickets = $resultTickets->fetch_assoc();
    $total_tickets = $rowTickets['total'] ?? 0;
  } else {
    $total_tickets = 0;
  }
}

if (isset($_SESSION['user_id'])) {
  $checkSpent = $conn->prepare("SELECT SUM(price) AS total_spent FROM tickets WHERE user_id = ?");
  $checkSpent->bind_param("i", $_SESSION['user_id']);
  $checkSpent->execute();
  $resultSpent = $checkSpent->get_result();

  if ($resultSpent->num_rows > 0) {
    $rowSpent = $resultSpent->fetch_assoc();
    $total_spent = $rowSpent['total_spent'];
  } else {
    $total_spent = 0;
  }
}

$user_tickets = [];
if (isset($_SESSION['user_id'])) {
  $ticketQuery = $conn->prepare("SELECT * FROM tickets WHERE user_id = ? ORDER BY ticket_id DESC");
  $ticketQuery->bind_param("i", $_SESSION['user_id']);
  $ticketQuery->execute();
  $ticketResult = $ticketQuery->get_result();

  if ($ticketResult && $ticketResult->num_rows > 0) {
    while ($ticket = $ticketResult->fetch_assoc()) {
      $user_tickets[] = $ticket;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link rel="stylesheet" href="../../styles/profile.css" />
</head>

<body>
  <div class="profile-page">
    <aside class="profile-sidebar">
      <div class="profile-avatar-block">
        <div class="profile-avatar">
          <span class="avatar-initials"><?= getInitials($_SESSION['user_name'] ?? 'Guest') ?></span>
          <div class="avatar-ring"></div>
        </div>
        <div class="profile-meta">
          <?php if (isset($_SESSION['user_name'])): ?>
            <p class="profile-username"><?= htmlspecialchars($_SESSION['user_name']); ?></p>
          <?php else: ?>
            <p class="profile-username">Guest</p>
          <?php endif; ?>

          <?php if (isset($_SESSION['user_email'])): ?>
            <p class="profile-email"><?= htmlspecialchars($_SESSION['user_email']); ?></p>
          <?php else: ?>
            <p class="profile-email">No Email</p>
          <?php endif; ?>
        </div>
      </div>

      <nav class="profile-sidenav">
        <a href="#manage-profile" class="sidenav-item active">
          <span class="sidenav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 21a8 8 0 0 1 10.821-7.487" />
              <path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
              <circle cx="10" cy="8" r="5" />
            </svg>
          </span>
          <span>Manage Profile</span>
        </a>
        <a href="#manage-ticket" class="sidenav-item">
          <span class="sidenav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" />
              <path d="M13 5v2" />
              <path d="M13 17v2" />
              <path d="M13 11v2" />
            </svg>
          </span>
          <span>Manage Tickets</span>
        </a>
        <a href="/views/index.php" class="sidenav-item home-btn" title="Back to Home">
          <span class="sidenav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
              <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
          </span>
          <span>Home</span>
        </a>
        <a href="/views/login-register/login.php" class="sidenav-item logout-btn" title="Logout">
          <span class="sidenav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
              <polyline points="16 17 21 12 16 7" />
              <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
          </span>
          <span>Logout</span>
        </a>
      </nav>

      <!-- <nav class="sidebar-bottom-nav">
        
      </nav> -->
    </aside>

    <main class="profile-main">

      <div class="profile-page-heading">
        <div class="profile-hero-card">
          <div>
            <p class="profile-tag">Profile</p>
            <h1>Manage your account</h1>
            <p class="profile-subtitle">Update your username or password, and review your ticket purchases on a clean profile screen.</p>
          </div>
        </div>
      </div>

      <nav class="profile-tabs" style="display: none;">
        <a href="#manage-profile" class="profile-tab profile-tab--active">Manage Profile</a>
        <a href="#manage-ticket" class="profile-tab">Manage Ticket</a>
      </nav>

      <section class="profile-section active" id="manage-profile">
        <div class="section-header">
          <h1>Manage Profile</h1>
          <p>Update your account information below.</p>
        </div>

        <div class="profile-cards-grid">

          <div class="profile-card">
            <div class="profile-card-label">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4" />
                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8" />
              </svg>
              <p>Username</p>
            </div>
            <div class="profile-card-body">
              <div class="input-group">
                <label>Current Username</label>
                <div class="input-display"><span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></div>
              </div>
              <div class="input-group">
                <label for="new-username">New Username</label>
                <input type="text" id="new-username" name="new_username" placeholder="Enter new username" />
              </div>
              <div class="input-group">
                <label for="confirm-username-password">Confirm with Password</label>
                <input type="password" id="confirm-username-password" name="confirm_password_username" placeholder="Enter your password" />
              </div>
            </div>
            <div class="profile-card-footer">
              <button class="btn-save" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                  <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                  <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                </svg>
                Save Username
              </button>
            </div>
          </div>

          <div class="profile-card">
            <div class="profile-card-label">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="16" r="1" />
                <rect x="3" y="10" width="18" height="12" rx="2" />
                <path d="M7 10V7a5 5 0 0 1 10 0v3" />
              </svg>
              <p>Password</p>
            </div>
            <div class="profile-card-body">
              <div class="input-group">
                <label for="current-password">Current Password</label>
                <input type="password" id="current-password" name="current_password" placeholder="Enter current password" />
              </div>
              <div class="input-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new_password" placeholder="Enter new password" />
              </div>
              <div class="input-group">
                <label for="confirm-password">Confirm New Password</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter new password" />
              </div>
            </div>
            <div class="profile-card-footer">
              <button class="btn-save" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                  <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                  <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                </svg>
                Save Password
              </button>
            </div>
          </div>

          <div class="profile-card profile-card--info">
            <div class="profile-card-label">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                <path d="M16 22a4 4 0 0 0-8 0" />
                <circle cx="12" cy="15" r="3" />
              </svg>
              <p>Account Info</p>
            </div>
            <div class="profile-card-body">
              <div class="info-row">
                <p class="info-row-label">Email</p>
                <p class="info-row-value"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
              </div>
              <div class="info-row">
                <p class="info-row-label">Member Since</p>
                <p class="info-row-value"><?php echo htmlspecialchars($_SESSION['created_at']->format('F j, Y')); ?></p>
              </div>
              <div class="info-row">
                <p class="info-row-label">Total Tickets Bought</p>
                <p class="info-row-value"><?php echo htmlspecialchars($total_tickets); ?></p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <section class="profile-section" id="manage-ticket">
        <div class="section-header">
          <h1>Manage Tickets</h1>
          <p>Review your active ticket purchases below.</p>
        </div>

        <div class="ticket-summary-bar">
          <div class="ticket-stat">
            <p class="ticket-stat-label">Total Tickets</p>
            <p class="ticket-stat-value"><?php echo htmlspecialchars($total_tickets); ?></p>
          </div>
          <div class="ticket-stat">
            <p class="ticket-stat-label">Total Spent</p>
            <p class="ticket-stat-value">₱<?php echo htmlspecialchars(number_format($total_spent, 2)); ?></p>
          </div>
        </div>

        <div class="ticket-list">
          <?php if (!empty($user_tickets)): ?>
            <?php foreach ($user_tickets as $ticket): ?>
              <div class="ticket-card <?= htmlspecialchars(getTicketCardClass($ticket['zone'])) ?>">
                <div class="ticket-zone-strip">
                  <p class="ticket-zone-label"><?= htmlspecialchars($ticket['zone']) ?></p>
                </div>
                <div class="ticket-event-info">
                  <p class="ticket-event-name">WORLD TOUR 2026</p>
                  <div class="ticket-meta-row">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                      </svg>
                      August 15, 2026
                    </span>
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                      </svg>
                      Smart Araneta Coliseum
                    </span>
                  </div>
                  <div class="ticket-meta-row">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" x2="20" y1="9" y2="9" />
                        <line x1="4" x2="20" y1="15" y2="15" />
                        <line x1="10" x2="8" y1="3" y2="21" />
                        <line x1="16" x2="14" y1="3" y2="21" />
                      </svg>
                      Ticket #<?= htmlspecialchars($ticket['transac_no']) ?>
                    </span>
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z" />
                        <path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12" />
                        <path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17" />
                      </svg>
                      <?= htmlspecialchars($ticket['quantity']) ?> ticket<?= $ticket['quantity'] > 1 ? 's' : '' ?>
                    </span>
                  </div>
                </div>
                <div class="ticket-price-status">
                  <p class="ticket-price">₱<?= number_format($ticket['price'], 2) ?></p>
                  <span class="ticket-status-pill ticket-status--confirmed">Confirmed</span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="ticket-empty-state">
              <p>You have not purchased any tickets yet.</p>
            </div>
          <?php endif; ?>
        </div>
      </section>

    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidenavItems = document.querySelectorAll('.sidenav-item:not(.logout-btn):not(.home-btn)');
      const logoutBtn = document.querySelector('.logout-btn');
      const sections = document.querySelectorAll('.profile-section');

      sidenavItems.forEach(item => {
        item.addEventListener('click', function(e) {
          if (!this.getAttribute('href').startsWith('../../')) {
            e.preventDefault();
          }

          sidenavItems.forEach(nav => nav.classList.remove('active'));
          this.classList.add('active');

          const href = this.getAttribute('href');
          if (!href.startsWith('../../')) {
            const targetId = href.substring(1);

            sections.forEach(section => section.classList.remove('active'));
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
              targetSection.classList.add('active');
            }
          }
        });
      });

      logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to logout?')) {
          window.location.href = '/views/index.php';
        }
      });
    });
  </script>
</body>

</html>