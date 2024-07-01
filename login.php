<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "raining_drip";

$ligacao = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($ligacao->connect_error) {
    die("Connection failed: " . $ligacao->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar e vincular a consulta SQL
    $stmt = $ligacao->prepare("SELECT id, username, password FROM users WHERE username = ?");
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
                    alert('Login feito! A redirecionar para a Página Inicial...');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
          echo "<script> alert('Password inválida'); </script>";
        }
    } else {
      echo "<script> alert('Nenhum utilizador encontrado com esse Username.'); </script>";
    }
    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$ligacao->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Raining Drip</title>
    <link rel="icon" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    /* Login Estilo */

body {
  font-family: Arial, sans-serif;
}    
#Drip_login {
    display: flex;
    justify-content: center;
    height: 78.5vh;
    width: 100%;
    background-image: url("images/Design sem nome (9).png");
}

header img {
  width: 100px;
  margin-left: 10px;
}

#login {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 300px;
  height: fit-content;
  top: 20%;
  position: absolute;
}

#login h1 {
  color: #333;
  margin-bottom: 20px;
}

#login form {
  align-items: center;
}

#login label {
  width: 100%;
  margin-bottom: 5px;
  font-weight: bold;
  align-self: flex-start;
  text-align: left;
}

#login input[type="text"],
#login input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#login input[type="submit"] {
  background-color: #0a6ed7;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  transition: background-color 0.3s ease;
  margin-bottom: 20px;
}

#login input[type="submit"]:hover {
  background-color: #3f4969;
}


</style>
<body>

    <header>
        <a href="index.php"><img id="logo" src="images/Logo.png" alt="Site's logo"></a>
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
    <?php
        include('footer.php');
    ?>
</body>
</html>
