<?php

require_once("modelo/Pokemons.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$link = $_POST['link'];
$evolucao = $_POST['evolucao'];
$tipo1 = $_POST['tipo1'];
$tipo2 = $_POST['tipo2'];

$Card = new Pokemons(
    $_POST["nome"], 
    $_POST["descricao"], 
    $_POST["link"], 
    $_POST["tipo1"], 
    $_POST["tipo2"], 
    $_POST["evolucao"]);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="text-center d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <?php echo $Card->getGeraCard(); ?>
    </div>
</body>
<style>
    @font-face {
        font-family: 'Pokemon Classic';
        src: url('fonts/Pokemon-Classic.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body {
        font-family: 'Pokemon Classic', sans-serif;
        background-image: url("https://pokedle.net/img/Background.b373eb68.png");
        background-position: center top;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

</html>
