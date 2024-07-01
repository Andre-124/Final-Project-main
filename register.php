<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar se as senhas correspondem
    if ($password === $confirm_password) {
        // Verificar se a senha é segura
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) >= 8 && $uppercase && $lowercase && $number && $specialChars) {
            // Criptografar a senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Preparar e vincular a consulta SQL
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            // Executar a consulta
            if ($stmt->execute()) {
                // Redirecionar para a página de login após o registro
                header("Location: login.php");
                exit();
            } else {
                echo "Erro: " . $stmt->error;
            }

            // Fechar a declaração
            $stmt->close();
        } else {
            echo "A palavra-passe deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caráter especial.";
        }
    } else {
        echo "As palavras-passe têm de coincidir.";
    }
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo - Raining Drip</title>
    <link rel="icon" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    /* Register Estilo */

body {
  font-family: Arial, sans-serif;
}    
#Drip_login {
    display: flex;
    justify-content: center;
    height: 100vh;
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

#login input[type="text"], #login input[type="email"],
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
    <h1>Registo</h1>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <p>Já tens conta? <a href="login.php">Dá Login</a></p>
</section>
</div>
<?php
    include('footer.php');
?>
</body>
</html>
