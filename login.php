<?php
session_start();
$servername = "localhost";
$username = "root"; // substitua pelo seu usuário do MySQL
$password = ""; // substitua pela sua senha do MySQL
$dbname = "raining_drip";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar e vincular a consulta SQL
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();
        
        // Verificar a senha
        if (password_verify($password, $hashed_password)) {
            // Login bem-sucedido, definir sessão
            $_SESSION['userid'] = $id;
            $_SESSION['username'] = $username;
            
            // Exibir mensagem e redirecionar
            echo "<script>
                    alert('Login successful! Redirecting to homepage...');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Raining Drip</title>
</head>

<style>
    /* Login/Register Styles */

body {
  font-family: Arial, sans-serif;
}    
#Drip_login {
    display: flex;
    justify-content: center;
}

header img {
  width: 100px;
}

#login {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 300px;
}

#login h1 {
  color: #333;
  margin-bottom: 20px;
}

#login form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#login label {
  margin-bottom: 5px;
  font-weight: bold;
  align-self: flex-start;
}

#login input[type="text"],
#login input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#login input[type="submit"] {
  background-color: #5cb85c;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#login input[type="submit"]:hover {
  background-color: #4cae4c;
}
</style>
<body>

    <header>
        <a href="index.php"><img id="logo" src="images/Design sem nome (6).png" alt="Site's logo"></a>
    </header>
    <div id="Drip_login">
    <section id="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <p>Não tens conta? <a href="register.php">Regista-te</a></p>
    </section>
    </div>
</body>
</html>
