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
        <li id='logoSite'><a href="index.php#inicio"><img id="logo" src="images/Logo.png" alt="Site's logo"></a></li>
        <li><a href="index.php#sobrenos">Sobre Nós</a></li>
        <li><a href="Allsneakers.php">Sneakers</a></li>
    </ul>


    <div class="search-container">
        <form id="searchForm" action="" method="get">
            <input style='padding: 5px;' type="text" name="query" value="<?= htmlspecialchars($query) ?>" placeholder="Pesquisa...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <a href="ver_carrinho.php" class="cart-icon">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
                <span class="badge"><?php echo count($_SESSION['carrinho']); ?></span>
            <?php endif; ?>
        </a>
        <?php if (isset($_SESSION['username'])): ?>
        <a id="welcomeMsg" href=""><?php echo htmlspecialchars($_SESSION['username']); ?></a>
        <a href="logout.php" id="logoutBtn"><i class="fa-solid fa-right-to-bracket"></i></a>
        <?php else: ?>
            <a href="login.php" id="loginBtn">Login</a>
            <a href="register.php" id="registoBtn">Registo</a>
        <?php endif; ?>
    </div>
</header>