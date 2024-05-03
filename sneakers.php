<?php
include('ligacao.php');
?>
<?php
                $consulta = "SELECT * FROM produtos where Codproduto=" . $_GET['cod'];
              
                $resProdutos = $ligacao->query($consulta);

                $produto=$resProdutos->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raining Drip</title>
    <link rel="stylesheet" href="fds.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Design sem nome (6).png">
    <script src="https://kit.fontawesome.com/cc217ac7a1.js" crossorigin="anonymous"></script>
        
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

    <div class="container">
        <div class="product-image">
            <div id="product_viewer"></div>
        </div>
        <div class="product-details">
            <h2>Menu de Compra de Tênis</h2>
            <form id="compraForm">
                <label for="tamanho">Escolha o tamanho:</label>
                <select id="tamanho">
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                </select>
                <br>
                <div>Preço: <?= $produto['Preco'] ?>€</div>
                <button class="nike-button">Add to Cart</button>
            </form>
        </div>
    </div>

    <script src="js/product-viewer.js"></script>
  
    <script>
      var productViewer = new ProductViewer ({
        element: document.getElementById('product_viewer'),
        imagePath: 'images/<?= $produto['imagens'] ?>',
        filePrefix: 'img',
        fileExtension: '.avif'
      });
  
      // if you want to see it will roted 360 deg once it loaded then you have to write some extra code
  
      ProductViewer.once('loaded', function (){
        ProductViewer.animate360();
      })
  
    </script>

</body>
</html>
