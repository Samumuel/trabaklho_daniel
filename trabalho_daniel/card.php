<?php

require_once("util/Conexao.php");
require_once("modelo/Pokemons.php");

$con = Conexao::getConexao();
$sql = "SELECT * FROM pokemon";
$stm = $con->prepare($sql);
$stm->execute();
$pokemons = $stm->fetchAll();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container py-5">
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <?php
            foreach ($pokemons as $pk) {
                $pokemon = new Pokemons();
                $pokemon->setNome($pk["nome"]);
                $pokemon->setDescricao($pk["descricao"]);
                $pokemon->setLink($pk["link"]);
                $pokemon->setEvolucao($pk["evolucao"]);
                $pokemon->setTipo1($pk["tipo1"]);
                $pokemon->setTipo2($pk["tipo2"]);

                echo $pokemon->getGeraCard();
            }
            ?>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href='index.php' class='btn btn-outline-dark btn-sm card rounded-4 border border-3 border-primary text-center' style='width: 12rem'>
                Cadastrar outro Pokémon
            </a>
        </div>
    </div>
</body>

</html>