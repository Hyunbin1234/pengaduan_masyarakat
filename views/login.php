<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM User WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username]);

  $user = $stmt->fetch();
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['role'] = $user['role'];
    header("Location: " . ($user['role'] == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
  } else {
    echo "Login gagal! Username atau password salah.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
     <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.login-container {
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #333;
    font-size: 2.5em;
    margin-bottom: 10px;
    text-align: center;
}

p {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
}

p b {
    color: #764ba2;
}

form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

label {
    color: #555;
    font-size: 0.9em;
    font-weight: 500;
    margin-bottom: -15px;
}

input {
    width: 100%;
    padding: 15px;
    border: 2px solid #e1e1e1;
    border-radius: 10px;
    font-size: 1em;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
}

input:focus {
    outline: none;
    border-color: #764ba2;
    box-shadow: 0 0 10px rgba(118, 75, 162, 0.2);
}

input::placeholder {
    color: #aaa;
}

button {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
}

button:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 480px) {
    .login-container {
        padding: 20px;
        margin: 20px;
        border-radius: 15px;
    }

    h1 {
        font-size: 2em;
    }

    input, button {
        padding: 12px;
    }
}

/* Animation for form elements */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-container {
    animation: fadeIn 0.8s ease-out;
}

/* Focus effect for inputs */
input:focus::placeholder {
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.3s ease;
}

     </style>
</head>
<body>
    <div class="login-container">   
        <h1>Login</h1>
        <p>Login with <b>User 'Public', Pass 'Password'</b> to enter the website Application!</p>
        <form method="POST">
            <label for="text">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


