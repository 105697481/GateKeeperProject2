<?php
require_once 'settings.php'; // connect to DB
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $message = "<p class='error'>Please fill in both fields.</p>";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            $message = "<p class='error'>Password must be at least 8 characters long, contain at least one uppercase letter and one number.</p>"; 
    } else {
        // Check if username already exists ( Use Prepared statements to prevent sql injection)
        $check = $conn->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) { //Checks if there is any record inside the variable check
            $message = "<p class='error'>⚠️ Username already exists. Try another one.</p>";
        } else {
            // Hash password before storing
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $message = "<p class='success'>✅ Signup successful! You can now <a href='login.php'>login</a>.</p>";
            } else {
                $message = "<p class='error'>Something went wrong. Please try again.</p>";
            }

            $stmt->close();
        }

        $check->close();
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    
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

/* Signup box */
.signup-container {
  background-color: rgba(245, 245, 247, 0.5);
  border: 2px solid #034EA2;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  padding: 30px 40px;
  width: 350px;
  text-align: center;
}

/* Heading */
.signup-container h2 {
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

/* Success and error messages */
.success {
  color: green;
  font-weight: bold;
  margin-bottom: 10px;
}
.error {
  color: red;
  font-weight: bold;
  margin-bottom: 10px;
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
  <div class="signup-container">
    <h2>Signup</h2>
    <?php if (!empty($message)) echo $message; ?>
    <form method="POST" action="sign_up.php" novalidate>
        <label>Username:</label>
        <input type="text" name="username">

        <label>Password:</label>
        <input type="password" name="password">

        <button type="submit">Sign Up</button>
    </form>
  </div>
</body>
</html>