<?php
// Include your database connection file
include('ligacao.php');

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize errors array
$errors = [];

// Associative array to map form field keys to Portuguese labels
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    foreach ($field_labels as $key => $label) {
        if (!isset($_POST[$key]) || empty(trim($_POST[$key]))) {
            $errors[] = $label . ' é obrigatório.';
        }
    }

    // If no errors, process the payment (you can add your processing logic here)
    if (empty($errors)) {
        // Payment processing logic here (e.g., save to database, send confirmation emails, etc.)
        $_SESSION['carrinho'] = [];
        // Assuming payment is successful, set success message
        echo "<script>
        alert('Tudo pronto! Agora basta esperares que a tua encomenda chegue.');
        window.location.href = 'index.php';
        </script>";
        // Redirect to checkout page or another page after processing
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
    <!-- Include Bootstrap CSS -->
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
                    </div>
                <?php elseif (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                    </div>
                    <script>
                        // Redirect after showing the alert
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 3000); // 3 seconds
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>

