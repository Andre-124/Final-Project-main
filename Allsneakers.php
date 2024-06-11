<?php
include('ligacao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raining Drip</title>
    <link rel="stylesheet" href="drip.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Design sem nome (6).png">
</head>
<body>

<?php include('cabecalho.php');?>

<?php
$consulta = "SELECT * FROM produtos";
$resProdutos = $ligacao->query($consulta);

echo '<h1 id="allsneakers_title">All Sneakers</h1>';

if ($resProdutos->num_rows > 0) {
    // Output data of each row
    while($produto = $resProdutos->fetch_assoc()){
        echo '<div class="card_sneakers">';
        echo '    <a href="sneakers.php?cod=' . $produto['Codproduto'] . '">';
        echo '        <img src="images/' . $produto['imagens'] . '" alt="' . $produto['Nome'] . '">';
        echo '        <div class="card_container">';
        echo '            <h4>' . $produto['Nome'] . '</h4>';
        echo '            <h5>' . $produto['Preco'] . '€</h5>';
        echo '            <p>' . $produto['Modelo'] . '</p>';
        echo '            <p>' . $produto['ImagemRef'] . '</p>';
        echo '        </div>';
        echo '    </a>';
        echo '</div>';
    }
} else {
    echo "No products found.";
}
?>

</body>
</html>