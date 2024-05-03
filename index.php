<?php
include('ligacao.php');
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
    <script src="https://kit.fontawesome.com/cc217ac7a1.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Sedan+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fds.css">
</head>
<body>  

<header>
    <ul id="menu">        
        <li><a href="index.php">Início</a></li>
        <li><a href="#sobrenos">Sobre Nós</a></li>
        <li><a href="#sneakers">Sneakers</a></li>
        <li><a href="#contatos">Contactos</a></li>
        <li><a href="carrinho.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>          
    <a href="#"><img id="logo" src="images/Design sem nome (6).png" alt="Site's logo"></a>
</header>

<section id="início"></section>

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
        $consulta = "SELECT * FROM produtos";
        $resProdutos = $ligacao->query($consulta);
        while($produto= $resProdutos->fetch_assoc()){


        ?>
                    <div class="card_sneakers">
                        <a href="sneakers.php?cod=<?= $produto['Codproduto'] ?>">
                            <img src="images/<?= $produto['ImagemRef'] ?>" alt="<?= $produto['Nome'] ?>">
                            <div class="card_conteiner">
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
    <p>
        A Raining Drip tem como objetivo deixar todos os nossos clientes bem servidos e também oferecer melhores calçados com os preços mais acessíveis no mercado de Resell.
    </p>
</section>

</body>
</html>
