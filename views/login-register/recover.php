<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recover | Online Concert Ticketing</title>
  <link rel="stylesheet" href="/styles/login-register.css">
</head>
<body>
  <hero>
    <div class="auth-shell">
    <article class="auth-card">
      <header class="auth-hero">
        <span class="hero-tag">Account Recovery</span>
        <div class="hero-headline">
          <h3>Recover</h3>
        </div>
        <p class="hero-text">Enter your email and we'll send a secure recovery PIN to get you back into your ticket account.</p>
      </header>

      <form class="auth-form" action="#" method="post" autocomplete="off">
        <div class="note-block">
          Admin will send a recovery PIN to the provided email address.
        </div>

        <div class="form-group">
          <input id="recover-email" name="email" type="email" placeholder=" " autocomplete="email">
          <label for="recover-email">Email Address</label>
        </div>

        <div class="link-row">
          <a href="login.php">Back to login</a>
        </div>

        <button type="submit">Request PIN</button>
      </form>

      <div class="auth-footer">
        <span>Recovery</span>
        <span>One secure PIN to restore access.</span>
      </div>
    </article>
  </div>
  </hero>
</body>
</html>
