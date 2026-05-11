<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../../styles/admin-dashboard.css" />
</head>

<body>
  <div class="admin-page">
    <aside class="admin-sidebar">
      <div class="admin-avatar-block">
        <div class="admin-avatar">
          <span class="avatar-initials">AD</span>
          <div class="avatar-ring"></div>
        </div>
        <div class="admin-meta">
          <p class="admin-username">Admin Dashboard</p>
          <p class="admin-email">administrator@gmail.com</p>
        </div>
      </div>

      <nav class="admin-sidenav">
        <a href="#admin-page-heading" class="sidenav-item active">
          <span class="sidenav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16.051 12.616a1 1 0 0 1 1.909.024l.737 1.452a1 1 0 0 0 .737.535l1.634.256a1 1 0 0 1 .588 1.806l-1.172 1.168a1 1 0 0 0-.282.866l.259 1.613a1 1 0 0 1-1.541 1.134l-1.465-.75a1 1 0 0 0-.912 0l-1.465.75a1 1 0 0 1-1.539-1.133l.258-1.613a1 1 0 0 0-.282-.866l-1.156-1.153a1 1 0 0 1 .572-1.822l1.633-.256a1 1 0 0 0 .737-.535z"/><path d="M8 15H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/></svg></span>
          <span>Admin Dashboard</span>
        </a>
        <a href="#chart-container" class="sidenav-item">
          <span class="sidenav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="m9.5 14.5 5-5"/></svg></span>
          <span>Ticket by Zone</span>
        </a>
        <a href="#table-container" class="sidenav-item">
          <span class="sidenav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="m9 12 2 2 4-4"/></svg></span>
          <span>Ticket by Sales</span>
        </a>
        <a href="/views/index.php" class="sidenav-item home-btn" title="Back to Home">
          <span class="sidenav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg></span>
          <span>Home</span>
        </a>
        <a href="/views/login-register/login.php" class="sidenav-item logout-btn" title="Logout">
          <span class="sidenav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" /></svg></span>
          <span>Log Out</span>
        </a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-page-heading" id="admin-page-heading">
        <div class="admin-hero-card">
          <div>
            <p class="admin-tag">Admin Dashboard</p>
            <h1>Sales Overview</h1>
            <p class="admin-subtitle">Monitor ticket sales, revenue, and buyer analytics in real-time.</p>
          </div>
        </div>
      </div>

      <section class="admin-section active" id="dashboard">
        <div class="section-header">
          <h1>Dashboard Overview</h1>
          <p>Real-time statistics and ticket sales data.</p>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-header">
              <p class="stat-label">Total Tickets Sold</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" /><path d="M13 5v2" /><path d="M13 17v2" /><path d="M13 11v2" /></svg>
            </div>
            <p class="stat-value">10</p>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <p class="stat-label">Total Revenue</p>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-philippine-peso-icon lucide-philippine-peso"><path d="M20 11H4"/><path d="M20 7H4"/><path d="M7 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7"/></svg>
            </div>
            <p class="stat-value">₱125,000.00</p>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <p class="stat-label">Total Buyers</p>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>
            </div>
            <p class="stat-value">4</p>
          </div>
        </div>

        <div class="chart-container" id="chart-container">
          <div class="chart-card">
            <div class="chart-header">
              <h3>Ticket Sales by Zone</h3>
              <p>Distribution of ticket sales across different seating zones</p>
            </div>
            <div class="chart-table-wrapper">
              <table class="chart-table">
                <thead>
                  <tr>
                    <th>Zone</th>
                    <th>Tickets Sold</th>
                    <th>Percentage</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="zone-row">
                        <span class="zone-indicator zone-indicator-vip"></span>
                        <span>VIP</span>
                      </div>
                    </td>
                    <td class="chart-value">2</td>
                    <td>
                      <div class="percentage-row">
                        <div class="percentage-bar">
                          <div class="percentage-fill" style="width: 20%"></div>
                        </div>
                        <span class="percentage-text">20.0%</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="zone-row">
                        <span class="zone-indicator zone-indicator-upper-box"></span>
                        <span>Upper Box</span>
                      </div>
                    </td>
                    <td class="chart-value">4</td>
                    <td>
                      <div class="percentage-row">
                        <div class="percentage-bar">
                          <div class="percentage-fill" style="width: 40%"></div>
                        </div>
                        <span class="percentage-text">40.0%</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="zone-row">
                        <span class="zone-indicator zone-indicator-lower-box"></span>
                        <span>Lower Box</span>
                      </div>
                    </td>
                    <td class="chart-value">3</td>
                    <td>
                      <div class="percentage-row">
                        <div class="percentage-bar">
                          <div class="percentage-fill" style="width: 30%"></div>
                        </div>
                        <span class="percentage-text">30.0%</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="zone-row">
                        <span class="zone-indicator zone-indicator-general-admission"></span>
                        <span>General Admission</span>
                      </div>
                    </td>
                    <td class="chart-value">1</td>
                    <td>
                      <div class="percentage-row">
                        <div class="percentage-bar">
                          <div class="percentage-fill" style="width: 10%"></div>
                        </div>
                        <span class="percentage-text">10.0%</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="table-container" id="table-container">
          <div class="table-header">
            <h2>All Ticket Sales</h2>
            <p>Detailed list of all ticket purchases</p>
          </div>
          <div class="table-wrapper">
            <table class="sales-table">
              <thead>
                <tr>
                  <th>Buyer Name</th>
                  <th>Email</th>
                  <th>Seat Zone</th>
                  <th>Section</th>
                  <th>Quantity</th>
                  <th>Total Paid</th>
                  <th>Date Purchased</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="buyer-cell">
                      <span class="buyer-avatar">M</span>
                      <span>MamaMo</span>
                    </div>
                  </td>
                  <td>MamaMo@gmail.com</td>
                  <td>
                    <span class="zone-badge zone-vip">VIP</span>
                  </td>
                  <td>101</td>
                  <td><span class="quantity-badge">2</span></td>
                  <td class="amount">₱39,000.00</td>
                  <td>2026-05-10</td>
                </tr>
                <tr>
                  <td>
                    <div class="buyer-cell">
                      <span class="buyer-avatar">P</span>
                      <span>PapaMo</span>
                    </div>
                  </td>
                  <td>PapaMo@gmail.com</td>
                  <td>
                    <span class="zone-badge zone-upper-box">Upper Box</span>
                  </td>
                  <td>202</td>
                  <td><span class="quantity-badge">4</span></td>
                  <td class="amount">₱56,000.00</td>
                  <td>2026-05-09</td>
                </tr>
                <tr>
                  <td>
                    <div class="buyer-cell">
                      <span class="buyer-avatar">K</span>
                      <span>KuyaMo</span>
                    </div>
                  </td>
                  <td>KuyaMo@gmail.com</td>
                  <td>
                    <span class="zone-badge zone-lower-box">Lower Box</span>
                  </td>
                  <td>403</td>
                  <td><span class="quantity-badge">3</span></td>
                  <td class="amount">₱27,000.00</td>
                  <td>2026-05-08</td>
                </tr>
                <tr>
                  <td>
                    <div class="buyer-cell">
                      <span class="buyer-avatar">A</span>
                      <span>AteMo</span>
                    </div>
                  </td>
                  <td>AteMo@gmail.com</td>
                  <td>
                    <span class="zone-badge zone-general-admission">General Admission</span>
                  </td>
                  <td>GenAdm</td>
                  <td><span class="quantity-badge">1</span></td>
                  <td class="amount">₱3,000.00</td>
                  <td>2026-05-07</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </section>

    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidenavItems = document.querySelectorAll('.sidenav-item:not(.logout-btn):not(.home-btn)');
      
      sidenavItems.forEach(item => {
        item.addEventListener('click', function(e) {
          const href = this.getAttribute('href');
          
          if (href.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
              target.scrollIntoView({ behavior: 'smooth' });
            }
          }

          sidenavItems.forEach(nav => nav.classList.remove('active'));
          this.classList.add('active');
        });
      });

      window.addEventListener('scroll', function() {
        const sections = [
          { id: 'admin-page-heading', link: document.querySelector('a[href="#admin-page-heading"]') },
          { id: 'chart-container', link: document.querySelector('a[href="#chart-container"]') },
          { id: 'table-container', link: document.querySelector('a[href="#table-container"]') }
        ];
        
        let current = '';
        for (let section of sections) {
          const el = document.getElementById(section.id);
          if (el) {
            const sectionTop = el.offsetTop - 150;
            if (window.scrollY >= sectionTop) {
              current = section.id;
            }
          }
        }
        
        sidenavItems.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
          }
        });
      });
    });
  </script>
</body>

</html>