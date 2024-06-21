<?php
include('ligacao.php');

$query = isset($_GET['query']) ? $ligacao->real_escape_string($_GET['query']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raining Drip</title>
    <link rel="icon" href="images/Design sem nome (6).png">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
    <script src="js/slideshow.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Sedan+SC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="drip.css">
</head>
<body>
    <?php include('cabecalho.php'); ?>
    <div class="checkoutDiv" style="margin: 2em 0">
        <?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) { ?>
            <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Carrinho</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h5 class="my-0">Produtos</h5>
                    </div>
                    </li>
                    <?php
                        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                            $total = 0;
                            foreach ($_SESSION['carrinho'] as $index => $item) {
                                echo "<li class=\"list-group-item d-flex justify-content-between lh-condensed\">";
                                echo "<div>";
                                echo "<h1 style=\"font-size: 18px\">{$item['nome']}</h1>";
                                echo "<p class='cart-item-size' style=\"margin-bottom: 0;\">Tamanho: {$item['tamanho']}</p>";
                                echo "</div>";
                                echo "<span class=\"text-muted\">{$item['preco']}€</span>";
                                echo "</li>";
                            }

                            $total += $item['preco'];

                            echo "<li class=\"list-group-item d-flex justify-content-between\">";
                            echo "<span>Total (EUR)</span>"; 
                            echo "<strong>{$total}€</strong>";  
                            echo "</li>";
                        }
                    ?>
                </ul>
                </div>
                <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Endereço e Informações Pessoais</h4>
                <form class="needs-validation" action="checkoutSubmit.php" method="POST" novalidate="">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form class="needs-validation" action="checkoutSubmit.php" method="POST" novalidate>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Primeiro nome</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Primeiro nome é obrigatório.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Último nome</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Último nome é obrigatório.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Introduza um email válido.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Rua Principal, nº1234" required>
                    <div class="invalid-feedback">
                        Endereço é obrigatório.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Endereço 2 <span class="text-muted">(Opcional)</span></label>
                    <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartmento or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">País</label>
                        <select class="custom-select d-block w-100" id="country" name="country" required>
                            <option value="">Escolher...</option>
                            <option>Portugal</option>
                        </select>
                        <div class="invalid-feedback">
                            Escolha um país válido.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Distrito/Estado</label>
                        <select class="custom-select d-block w-100" id="state" name="state" required>
                            <option value="">Escolher...</option>
                            <option>Aveiro</option>
                            <option>Beja</option>
                            <option>Braga</option>
                            <option>Bragança</option>
                            <option>Castelo Branco</option>
                            <option>Coimbra</option>
                            <option>Évora</option>
                            <option>Faro</option>
                            <option>Guarda</option>
                            <option>Leiria</option>
                            <option>Lisboa</option>
                            <option>Portalegre</option>
                            <option>Porto</option>
                            <option>Santarém</option>
                            <option>Setúbal</option>
                            <option>Viana do Castelo</option>
                            <option>Vila Real</option>
                            <option>Viseu</option>
                        </select>
                        <div class="invalid-feedback">
                            Escolha um distrito válido.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Código Postal</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Código Postal é obrigatório.
                        </div>
                    </div>
                </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">O endereço de entrega é o mesmo de faturação</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Pagamento</h4>

                    <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" onclick="togglePaymentMethod('credit')" checked required>
                        <label class="custom-control-label" for="credit">Cartão de crédito</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" onclick="togglePaymentMethod('debit')" required>
                        <label class="custom-control-label" for="debit">Cartão de débito</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" onclick="togglePaymentMethod('paypal')" required>
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                    </div>
                    <div id="paymentSection">
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Nome no cartão</label>
                        <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required="">
                        <small class="text-muted">Nome completo como exposto no cartão</small>
                        <div class="invalid-feedback">
                        Nome no cartão é obrigatório
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Número do cartão</label>
                        <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required="">
                        <div class="invalid-feedback">
                        Número do cartão é obrigatório
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Validade</label>
                        <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required="">
                        <div class="invalid-feedback">
                            Validade do cartão é obrigatório
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required="">
                        <div class="invalid-feedback">
                        CVV é obrigatório
                        </div>
                    </div>
                    </div>
                    </div>
                    <hr class="mb-4">
                    <button id="submitButton" class="btn btn-dark btn-lg btn-block" type="submit">Continuar para o pagamento</button>
                </form>
                </div>
            </div>
        </div>
        <?php    
            } else {
                echo "<div id=\"divCheckout-Vazio\">";
                echo "<p>Não existe nada para pagares.</p>";
                echo "</div>";
            }
        ?>
    </div>
    <?php include('footer.php'); ?>
    <script>
        function togglePaymentMethod(method) {
            var paymentSection = document.getElementById('paymentSection');
            var submitButton = document.getElementById('submitButton');

            if (method === 'paypal') {
                paymentSection.style.display = 'none';
                submitButton.textContent = 'Pagar com PayPal';
            } else {
                paymentSection.style.display = 'block';
                submitButton.textContent = 'Continuar para o pagamento';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var paypal = document.getElementById('paypal');
            var paymentSection = document.getElementById('paymentSection');
            var submitButton = document.getElementById('submitButton');

            if (paypal.checked) {
                paymentSection.style.display = 'none';
                submitButton.textContent = 'Pagar com PayPal';
            } else {
                paymentSection.style.display = 'block';
                submitButton.textContent = 'Continuar para o pagamento';
            }
        });
    </script>
</body>
</html>