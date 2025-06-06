<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getConexao();
$sql = "DELETE FROM pokemon WHERE id = ?";
if (isset($_GET["excluir"])) {
    $stm = $con->prepare($sql);
    $stm->execute([$_GET["excluir"]]);
    $pokemons = $stm->fetchAll();

    header("location: index.php");
} else {
    echo "<h1>Você deve retornar a página principal</h1><br> <a href='index.php'>retornar</a> ";
}
