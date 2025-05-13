<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      height: 100vh;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 1.5rem;
      color: #333;
    }

    .login-container input {
      width: 100%;
      padding: 10px;
      margin: 0.5rem 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: border 0.3s ease;
    }

    .login-container input:focus {
      border-color: #007BFF;
      outline: none;
    }

    .login-container button {
      width: 100%;
      padding: 10px;
      background: #007BFF;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 1rem;
      transition: background 0.3s ease;
    }

    .login-container button:hover {
      background: #0056b3;
    }

    .error-message {
      margin-top: 1rem;
      color: red;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login Admin</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>
  </div>
</body>
</html>
