<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Online Concert Ticketing</title>
  <link rel="stylesheet" href="/styles/login-register.css">
</head>
<body>
  <hero>
    <div class="auth-shell">
    <article class="auth-card">
      <header class="auth-hero">
        <span class="hero-tag">Create Account</span>
        <div class="hero-headline">
          <h3>Register</h3>
        </div>
        <p class="hero-text">Create your member account and get ready to book tickets in one smooth flow.</p>
      </header>

      <form class="auth-form" action="#" method="post" autocomplete="off">
        <div class="form-group">
          <input id="register-username" name="username" type="text" placeholder=" " autocomplete="username">
          <label for="register-username">Username</label>
        </div>

        <div class="form-group">
          <input id="register-email" name="email" type="email" placeholder=" " autocomplete="email">
          <label for="register-email">Email Address</label>
        </div>

        <div class="form-group">
          <input id="register-password" name="password" type="password" placeholder=" " autocomplete="new-password">
          <label for="register-password">Password</label>
        </div>

        <div class="form-group">
          <input id="register-confirm" name="confirm_password" type="password" placeholder=" " autocomplete="new-password">
          <label for="register-confirm">Confirm Password</label>
        </div>

        <div class="link-row">
          <span>Already have an account? <a href="login.php">Sign in</a></span>
        </div>

        <button type="submit">Register</button>
      </form>

      <div class="auth-footer">
        <span>Account to manage tickets, bookings, and concert access across every show.</span>
      </div>
    </article>
  </div>
</body>
</html>
