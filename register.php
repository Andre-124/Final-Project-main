<?php
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar se as senhas correspondem
    if ($password === $confirm_password) {
        // Criptografar a senha
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar e vincular a consulta SQL
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Executar a consulta
        if ($stmt->execute()) {
            // Redirecionar para index.php
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Passwords do not match.";
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
    <title>Register - Raining Drip</title>
    <link rel="stylesheet" href="drip.css">
</head>
<style>
    /* drip.css */
    h1{
        font-size: 25px;
        display: flex;
        justify-content: center;
        padding: 9px;
    }
#Register_drip{
    display: flex;
    justify-content: center;
}
#register {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

#register h1 {
    color: #333;
    margin-bottom: 20px;
}

#register form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#register label {
    margin-bottom: 5px;
    font-weight: bold;
    align-self: flex-start;
}

#register input[type="text"],
#register input[type="email"],
#register input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#register input[type="submit"] {
    background-color: #5cb85c;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#register input[type="submit"]:hover {
    background-color: #4cae4c;
}

</style>
<body>
    <header>
        <a href="index.php"><img id="logo" src="images/Design sem nome (6).png" alt="Site's logo"></a>
    </header>

    <h1>Register</h1>

    <div id="Register_drip">    
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
    </div>
</body>
</html>
