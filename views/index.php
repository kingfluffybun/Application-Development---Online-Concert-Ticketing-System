<?php
session_start();
// $user_name = $_SESSION['user_name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Document</title>
</head>
<body>
    <hero id="home">
        <div class="hero-banner-header">
            <img src="/assets/images/Logo_of_Blackpink.svg.png" width="400px" height="auto">
            <div class="in-your-area">
                <h1>IN YOUR AREA</h1>
            </div>
            <div class="hero-nav">
                <a href="#ticket" class="a-text"><p>Tickets</p></a>
                <!-- <a class="a-text"><p>Schedule</p></a> -->
                <a href="#members" class="a-text"><p>Members</p></a>
                <a class="a-text"><p>FAQ</p></a>
                <?php if (!isset($_SESSION['first_name'])): ?>
                    <a href='/views/login-register/login.php' class='a-text'><p>Login</p></a>
                <?php else: ?>
                    <a href="/views/profile/profile.php" class="a-text" style="display: flex; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg>
                        <p><?php echo htmlspecialchars($_SESSION['first_name']); ?></p>
                    </a>
                <?php endif; ?>

                <!-- <?php if (isset($_SESSION['user_email'])) {echo "<a href='/views/login-register/logout.php' class='a-text'><p>Logout</p></a>";} ?> -->
            </div>
        </div>
        <div class="hero-banner-container">
            <img src="/assets/images/hero-banner.jpg" alt="" class="hero-banner">
            <div class="hero-ticket-info">
                <div class="hero-ticket-info-content">
                    <h2 style="text-align: center; letter-spacing: 1.5px; font-size: 16px;">WORLD TOUR 2026</h2>
                    <img src="/assets/images/Logo_of_Blackpink.svg.png">
                    <div>
                        <h2>Smart Araneta Coliseum</h2>
                        <p>Quezon City, Philippines</p>
                    </div>
                    <div class="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-heart-icon lucide-calendar-heart"><path d="M12.127 22H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5.125"/><path d="M14.62 18.8A2.25 2.25 0 1 1 18 15.836a2.25 2.25 0 1 1 3.38 2.966l-2.626 2.856a.998.998 0 0 1-1.507 0z"/><path d="M16 2v4"/><path d="M3 10h18"/><path d="M8 2v4"/></svg>
                        <div>
                            <p>Date</p>
                            <p>August 15, 2026</p>
                        </div>
                    </div>
                    <div class="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock6-icon lucide-clock-6"><circle cx="12" cy="12" r="10"/><path d="M12 6v10"/></svg>
                        <div>
                            <p>Doors Open</p>
                            <p>6:00 PM</p>
                        </div>
                    </div>
                </div>
                <div class="player-buttons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shuffle-icon lucide-shuffle"><path d="m18 14 4 4-4 4"/><path d="m18 2 4 4-4 4"/><path d="M2 18h1.973a4 4 0 0 0 3.3-1.7l5.454-8.6a4 4 0 0 1 3.3-1.7H22"/><path d="M2 6h1.972a4 4 0 0 1 3.6 2.2"/><path d="M22 18h-6.041a4 4 0 0 1-3.3-1.8l-.359-.45"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-skip-back-icon lucide-skip-back"><path d="M17.971 4.285A2 2 0 0 1 21 6v12a2 2 0 0 1-3.029 1.715l-9.997-5.998a2 2 0 0 1-.003-3.432z"/><path d="M3 20V4"/></svg>
                    <div class="icon" id="play-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><path d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"/></svg></div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-skip-forward-icon lucide-skip-forward"><path d="M21 4v16"/><path d="M6.029 4.285A2 2 0 0 0 3 6v12a2 2 0 0 0 3.029 1.715l9.997-5.998a2 2 0 0 0 .003-3.432z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-repeat-icon lucide-repeat"><path d="m17 2 4 4-4 4"/><path d="M3 11v-1a4 4 0 0 1 4-4h14"/><path d="m7 22-4-4 4-4"/><path d="M21 13v1a4 4 0 0 1-4 4H3"/></svg>
                </div>
            </div>
        </div>
        <div class="hero-banner-content">
            <div>
                <p>Experience BLACKPINK live in Quezon City — </p>
                <p>the most iconic K-pop girl group takes the stage at Smart Araneta Coliseum</p>
            </div>
            <a href="seats.php"><p>Get Tickets Now</p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg></a>
        </div>
    </hero>
    <!-- <div class="ticket-pricing-banner"></div> -->
    <section class="ticket-pricing-section" id="ticket">
        <h1 class="ticket-pricing-header">Ticket Pricing</h1>
        <div style="display: flex; height: 72vh; flex-direction: column;">
            <div class="ticket-price-container">
                <div class="ticket-price" id="gen-ad">
                    
                    <div class="ticket-info">    
                        <p class="ticket-name">General Admission</p> 
                        <h2>₱3,000</h2>
                        <p>The ultimate fan experience. Standing room on the outermost sections, feel the energy of the crowd and sing along with thousands of BLINKs.</p>
                    </div>
                    <div class="advantage-container">
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Most affordable ticket</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Large capacity, more chances to get in</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Full view of the stage and light show</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Best crowd atmosphere</p>
                        </div>
                    </div>
                    <div class="buy-ticket">
                        <a href="seats.php"><p>BUY TICKETS</p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg></a>
                    </div>
                </div>
                <div class="ticket-price" id="upper-box">
                    
                    <div class="ticket-info">     
                        <p class="ticket-name">Upper Box</p>
                        <h2>₱9,000</h2>
                        <p>Elevated seating with a wide panoramic view of the entire stage. Perfect for fans who want a complete picture of the full production and performance.</p>
                    </div>
                    <div class="advantage-container">
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Guaranteed seat</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Bird's eye view of the full stage setup</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Great view of choreography and formations</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Less crowded, more comfortable</p>
                        </div>
                    </div>
                    <div class="buy-ticket">
                        <a href="seats.php"><p>BUY TICKETS</p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg></a>
                    </div>
                </div>
                <div class="ticket-price" id="lower-box">
                    
                    <div class="ticket-info">     
                        <p class="ticket-name">Lower Box</p>
                        <h2>₱14,000</h2>
                        <p>Get closer to the action with premium seated sections just above the floor. A near-perfect balance of proximity and comfort.</p>
                    </div>
                    <div class="advantage-container">
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Guaranteed seat</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Close enough to see facial expressions</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Better sightlines than Upper Box</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Access to lower box lounges</p>
                        </div>
                    </div>
                    <div class="buy-ticket">
                        <a href="seats.php"><p>BUY TICKETS</p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg></a>
                    </div>
                </div>
                <div class="ticket-price" id="vip">
                    
                    <div class="ticket-info">     
                        <p class="ticket-name">VIP</p>
                        <h2>₱19,500</h2>
                        <p>The closest you can get to BLACKPINK. Floor-level sections right in front of the stage — an intimate, high-energy experience you'll never forget.</p>
                    </div>
                    <div class="advantage-container">
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Closest proximity to the stage</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Priority entry</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Exclusive VIP lanyard & ticket stub</p>
                        </div>
                        <div class="advantage">
                            <div class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <p>Best position for hi-touch moments and fan interaction</p>
                        </div>
                    </div>
                    <div class="buy-ticket">
                        <a href="seats.php"><p>BUY TICKETS</p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="artist-section" id="members">
        <div class="artist-container">
            <div><img src="/assets/images/rose.jpg"></div>
            <div><img src="/assets/images/lisa.jpg"></div>
            <div><img src="/assets/images/jisoo.jpg"></div>
            <div><img src="/assets/images/jennie.jpg"></div>
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
                    <a href="#members"><p>Members</p></a>
                    <a href="#faq"><p>FAQ</p></a>
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
    <script src="../util/hero.js"></script>
</body>
</html>