<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Online Concert Ticketing</title>
  <link rel="stylesheet" href="/styles/login-register.css">
</head>
<body>
<?php
session_start();
include '../../db/db.php';
$error = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!ctype_alpha($firstname) || !ctype_alpha($lastname)) {
        $error = "Name should contain letters only.";
    } elseif (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i", $email)) {
        $error = "Invalid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
        $error = "Email is already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, user_email, user_password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $role);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}
?>
  <hero>
  <hero>
    <div class="auth-shell">
    <article class="auth-card">
      <header class="auth-hero">
        <!-- <span class="hero-tag">Create Account</span> -->
        <div class="hero-headline">
          <h3>Register</h3>
        </div>
        <p class="hero-text">Create your member account and get ready to book tickets in one smooth flow.</p>
      </header>

      <form class="auth-form" action="#" method="post" autocomplete="off">
        
        <?php if ($error !== null) {
            echo '<div class="login-error-message">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x-icon lucide-circle-x"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>';
            echo '<p>' . htmlspecialchars($error) . '</p>';
            echo '</div>';
        }; ?>
        
        <div style="display:flex; gap:12px;">
            <div class="form-group">
                <input id="register-firstname" name="firstname" type="text" placeholder=" " autocomplete="firstname">
                <label for="register-firstname">First Name</label>
                </div>
            <div class="form-group">
                <input id="register-lastname" name="lastname" type="text" placeholder=" " autocomplete="lastname">
                <label for="register-lastname">Last Name</label>
            </div>
        </div>

        <div class="form-group">
          <input id="register-email" name="email" type="email" placeholder=" " autocomplete="email">
          <label for="register-email">Email Address</label>
        </div>

        <div class="form-group password-group">
  <input id="register-password" name="password" type="password" placeholder=" " autocomplete="new-password">
  <label for="register-password">Password</label>

  <span class="toggle-password" data-target="register-password">
    <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>

    <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
  </span>
</div>

<div class="form-group password-group">
  <input id="register-confirm" name="confirm_password" type="password" placeholder=" " autocomplete="new-password">
  <label for="register-confirm">Confirm Password</label>

  <span class="toggle-password" data-target="register-confirm">
    <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>

    <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>

    <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
  </span>
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

  <script>
document.querySelectorAll(".toggle-password").forEach(toggle => {
  toggle.addEventListener("mousedown", (e) => {
    // prevent input blur so cursor won't jump
    e.preventDefault();
  });

  toggle.addEventListener("click", (e) => {
    e.stopPropagation();

    const inputId = toggle.getAttribute("data-target");
    const input = document.getElementById(inputId);

    if (!input) return;

    const eye = toggle.querySelector(".eye-icon");
    const eyeOff = toggle.querySelector(".eye-off-icon");

    // ✅ SAVE CURSOR POSITION BEFORE ANY CHANGES
    const cursorPosition = input.selectionStart;
    const selectionStart = input.selectionStart;
    const selectionEnd = input.selectionEnd;

    // toggle password visibility
    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";

    eye.classList.toggle("hidden", isPassword);
    eyeOff.classList.toggle("hidden", !isPassword);

    // ✅ RESTORE CURSOR POSITION IMMEDIATELY AFTER TYPE CHANGE
    // Use setTimeout to ensure DOM has updated
    setTimeout(() => {
      input.setSelectionRange(selectionStart, selectionEnd);
      // Ensure input maintains focus for seamless typing
      input.focus();
    }, 0);

    // keep natural typing flow (no focus reset)
  });
});
</script>
</body>
</html>
