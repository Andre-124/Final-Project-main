<?php
session_start();
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
    <link rel="stylesheet" href="drip.css">
</head>
<body>
    <?php include('cabecalho.php'); ?>
    
    <?php
    // Exibir mensagem de boas-vindas se o usuário estiver logado
    if (isset($_SESSION['username'])) {
        echo "<div id='welcome-message' class='alert alert-success' role='alert'>Bem-vindo, " . htmlspecialchars($_SESSION['username']) . "!</div>";
    }
    ?>

    <section id="inicio"></section>
    <section id="slideshow">
        <img class="mySlides" src="images/1.png" alt="Slideshow Image 1">
        <img class="mySlides" src="images/2.png" alt="Slideshow Image 2">
        <img class="mySlides" src="images/3.png" alt="Slideshow Image 3">
    </section>
    <section id="sneakers">
        <h1> Sneakers</h1>
        <a id="" href="Allsneakers.php"> All Sneakers</a>

        <div id="cards">
            <?php
            $consulta = "SELECT * FROM produtos LIMIT 3";
            $resProdutos = $ligacao->query($consulta);
            while($produto = $resProdutos->fetch_assoc()){
            ?>
                <div class="card_sneakers">
                    <a href="sneakers.php?cod=<?= $produto['Codproduto'] ?>">
                        <img src="images/<?= $produto['ImagemRef'] ?>" alt="<?= $produto['Nome'] ?>">
                        <div class="card_container">
                            <h4><?= $produto['Nome'] ?></h4>
                            <h5><?= $produto['Preco'] ?>€</h5>
                        </div>
                    </a>
                </div>
            <?php
            } 
            ?>
        </div>
    </section>
    <section id="sobrenos">
        <div id="sbLeft">
            <h1>Sobre nós</h1>
        </div>
        <div id="sbRight">
            <p>
                A Raining Drip tem como objetivo deixar todos os nossos clientes bem servidos e também oferecer melhores calçados com os preços mais acessíveis no mercado de Resell.
            </p>
        </div>
    </section>
    <?php include('footer.php'); ?>

    <script>
        // Temporizador para esconder a mensagem de boas-vindas após 5 segundos
        setTimeout(function() {
            var welcomeMessage = document.getElementById('welcome-message');
            if (welcomeMessage) {
                welcomeMessage.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
