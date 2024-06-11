<?php 

$query = isset($_GET['query']) ? $ligacao->real_escape_string($_GET['query']) : '';

?>

<?php if ($query): ?>
    <div class="Container_Pesquisa">
        <h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>
        <div class="products-list">
            <?php
            $consulta = "SELECT * FROM produtos WHERE Nome LIKE '%" . $query . "%'";
            $resProdutos = $ligacao->query($consulta);

            if ($resProdutos->num_rows > 0) {
                while($produto = $resProdutos->fetch_assoc()) {
                    ?>
                    <div class="product-item">
                        <img src="images/<?= htmlspecialchars($produto['ImagemRef']) ?>" alt="<?= htmlspecialchars($produto['Nome']) ?>">
                        <h3><?= htmlspecialchars($produto['Nome']) ?></h3>
                        <p>Preço: <?= htmlspecialchars($produto['Preco']) ?>€</p>
                        <a href="sneakers.php?cod=<?= htmlspecialchars($produto['Codproduto']) ?>" class="view-product">Ver Produto</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found matching your search query.</p>";
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

<header>
<script src="https://kit.fontawesome.com/cc217ac7a1.js" crossorigin="anonymous"></script>
    <ul id="menu">        
        <li id='logoSite'><a href="index.php"><img id="logo" src="images/Design sem nome (6).png" alt="Site's logo"></a></li>
        <li><a href="#sobrenos">Sobre Nós</a></li>
        <li><a href="#sneakers">Sneakers</a></li>
        <li><a href="#contatos">Contactos</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Registo</a></li>
        <li><a href="ver_carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>


    <div class="search-container">
        <form id="searchForm" action="" method="get">
            <input style='border-radius: 4px; padding: 5px;' type="text" name="query" value="<?= htmlspecialchars($query) ?>" placeholder="Pesquisa...">
            <button style='border-radius: 4px; padding: 5px;' type="submit">Procurar</button>
        </form>
    </div>
</header>