<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/login-register.css">
</head>
<body>
  <hero>
    <div class="auth-shell">
    <article class="auth-card">
      <header class="auth-hero">
        <span class="hero-tag">Member Access</span>
        <div class="hero-headline">
          <h3>Login</h3>
        </div>
        <p class="hero-text">Securely sign in to manage your tickets, orders, and concert seating details.</p>
      </header>

      <form class="auth-form" action="#" method="post" autocomplete="off">
        <div class="form-group">
          <input id="login-identifier" name="identifier" type="text" placeholder=" " autocomplete="username">
          <label for="login-identifier">Username or email</label>
        </div>

        <div class="form-group">
          <input id="login-password" name="password" type="password" placeholder=" " autocomplete="current-password">
          <label for="login-password">Password</label>
        </div>

        <div class="link-row">
          <a href="recover.php">Forgot password?</a>
        </div>

        <button type="submit">Sign In</button>

        <div class="form-footer">
          <span>Don’t have an account? <a href="register.php">Create account</a></span>
        </div>
      </form>

      <div class="auth-footer">
        <span>World Tour 2026</span>
        <span>Secure access to your ticket account.</span>
      </div>
    </article>
  </div>
  </hero>
</body>
</html>
