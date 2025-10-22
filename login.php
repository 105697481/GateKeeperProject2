<?php
require_once 'settings.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ADMIN shortcut
    if ($username === "admin" && $password === "admin") {
        session_regenerate_id(true);
        $_SESSION['username'] = "Admin";
        header("Location: manage.php");
        exit();
    }

    // Check normal users
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $message = "<p class='error'>❌ Incorrect password.</p>";
        }
    } else {
        $message = "<p class='error'>⚠️ Username not found.</p>";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
/* Background */
body {
  background-image: url(images/bgimage3.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  font-family: Verdana, Arial, sans-serif;
  color: #333;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

/* Login box */
.login-container {
  background-color: rgba(245, 245, 247, 0.5);
  border: 2px solid #034EA2;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  padding: 30px 40px;
  width: 350px;
  text-align: center;
}

/* Heading */
.login-container h2 {
  color: #034EA2;
  margin-bottom: 20px;
}

/* Labels & Inputs */
label {
  display: block;
  text-align: left;
  margin-bottom: 6px;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-bottom: 16px;
  box-sizing: border-box;
  font-size: 15px;
}

/* Button */
button {
  background-color: #0071e3;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 15px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #005bb5;
}

/* Messages */
.success {
  color: green;
  font-weight: bold;
  margin-top: 10px;
}
.error {
  color: red;
  font-weight: bold;
  margin-top: 10px;
}

/* Link */
a {
  color: #0071e3;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php if (!empty($message)) echo $message; ?>
    <form method="post" action="login.php" novalidate>
        <label>Username:</label>
        <input type="text" name="username">

        <label>Password:</label>
        <input type="password" name="password">

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
  </div>
</body>
</html>
