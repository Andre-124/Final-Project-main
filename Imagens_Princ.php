<?php
    while($produto = $resProdutos->fetch_assoc()) {
        // Fetch image URLs associated with the current product
        $produto_id = $produto['Codproduto'];
        $query_imagens = "SELECT url FROM imagens WHERE produto_id = $produto_id";
        $result_imagens = $ligacao->query($query_imagens);

        // Store image URLs in an array
        $image_urls = [];
        while ($imagem = $result_imagens->fetch_assoc()) {
            $image_urls[] = $imagem['url'];
        }

        // Add image URLs to the $produto array
        $produto['image_urls'] = $image_urls;

        // Now $produto array contains image URLs along with other product details
        // You can access them like $produto['image_urls'][0], $produto['image_urls'][1], etc.

        // Display other product details as usual
?>
        <div class="card_sneakers">
            <a href="sneakers.php?cod=<?= $produto['Codproduto'] ?>">
                <?php foreach ($produto['image_urls'] as $image_url): ?>
                    <img src="<?= $image_url ?>" alt="<?= $produto['Nome'] ?>">
                <?php endforeach; ?>
                <div class="card_conteiner">
                    <h4><?= $produto['Nome'] ?></h4>
                    <h5><?= $produto['Preco'] ?></h5>   
                </div>
            </a>
        </div>
<?php
    }
?>