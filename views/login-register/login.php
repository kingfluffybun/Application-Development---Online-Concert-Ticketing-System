<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/login-register.css">
</head>
<body>
<?php
session_start();
include '../../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE user_name = ? OR email = ?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
?>
  <hero>
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

        <div class="form-group password-group">
            <input id="login-password" name="password" type="password" placeholder=" " autocomplete="current-password">
            <label for="login-password">Password</label>

            <span class="toggle-password" data-target="login-password">
                <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>

    <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>

                <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
            </span>
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

  <script>
document.querySelectorAll(".toggle-password").forEach(toggle => {
  toggle.addEventListener("mousedown", (e) => {
    e.preventDefault();
  });

  toggle.addEventListener("click", (e) => {
    e.stopPropagation();

    const inputId = toggle.getAttribute("data-target");
    const input = document.getElementById(inputId);

    if (!input) return;

    const eye = toggle.querySelector(".eye-icon");
    const eyeOff = toggle.querySelector(".eye-off-icon");

    const cursorPosition = input.selectionStart;
    const selectionStart = input.selectionStart;
    const selectionEnd = input.selectionEnd;

    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";

    eye.classList.toggle("hidden", isPassword);
    eyeOff.classList.toggle("hidden", !isPassword);

    setTimeout(() => {
      input.setSelectionRange(selectionStart, selectionEnd);
      input.focus();
    }, 0);

  });
});
</script>
</body>
</html>
