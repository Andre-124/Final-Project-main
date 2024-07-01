<?php
include('ligacao.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];


$field_labels = [
    'firstName' => 'Primeiro nome',
    'lastName' => 'Último nome',
    'email' => 'Email',
    'address' => 'Endereço',
    'country' => 'País',
    'state' => 'Distrito/Estado',
    'zip' => 'Código Postal',
    'paymentMethod' => 'Método de pagamento',
    'cc-name' => 'Nome no cartão',
    'cc-number' => 'Número do cartão',
    'cc-expiration' => 'Validade do cartão',
    'cc-cvv' => 'CVV'
];

// Verifica se foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos requeridos
    foreach ($field_labels as $key => $label) {
        if (!isset($_POST[$key]) || empty(trim($_POST[$key]))) {
            $errors[] = $label . ' é obrigatório.';
        }
    }

    if (empty($errors)) {
        $_SESSION['carrinho'] = [];
        echo "<script>
        alert('Tudo pronto! Agora basta esperares que a tua encomenda chegue.');
        window.location.href = 'index.php';
        </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" href="images/Design sem nome (6).png">
    <link rel="stylesheet" href="drip.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('cabecalho.php'); ?> 
    <div class="container mt-5">
        <div class="row justify-content-center" style="width: 100%; height: 92vh;">
            <div class="col-md-6">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Erros no Formulário!</h4>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="btn btn-primary mt-3" href="javascript:history.back()">Voltar</a>
                    </div>
                <?php elseif (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 3000); 
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
