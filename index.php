<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getConexao();

$sql = "SELECT * FROM pokemon";
$stm = $con->prepare($sql);
$stm->execute();
$pokemons = $stm->fetchAll();

$nome  = "";
$tipo = "";
$estagio = "";
$hp = "";
$ataque = "";
$defesa = "";

$msgErro = "";


if (isset($_POST["titulo"])) {

    $titulo = trim($_POST["titulo"]);
    $genero = $_POST["genero"];
    $qtdPag = $_POST["paginas"];
    $autor = trim($_POST["autor"]);

    $length = strlen($titulo);

    //Validar os dados  
    $erros = array();
    if (! $titulo or $length < 3 or $length > 50) {
        array_push($erros, 'Informe um título maior que 3 caracteres e no máximo  50');
    } else {
        $sql = "SELECT id FROM livros WHERE titulo = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$titulo]);
        $result = $stm->fetchAll();

        if (count($result) > 0) {
            array_push($erros, "Já existe um livro com este título!");
        }
    }
    if (! $autor) {
        array_push($erros, 'Informe o Autor!');
    }
    if (! $genero) {
        array_push($erros, 'Informe o Genêro!');
    }
    if (! $qtdPag or $qtdPag <= 0) {
        array_push($erros, 'Informe um número de páginas maior que 0!');
    }
    if (count($erros) == 0) {
        //Inserir as informações na base de dados
        $sql = "INSERT INTO livros (titulo, genero, qtd_paginas, autor) 
    VALUES (?, ?, ?, ?)";
        $stm = $con->prepare($sql);
        $stm->execute([$titulo, $genero, $qtdPag, $autor]);

        //Redirecionar para a mesma pagina a fim de limpar o buffer do navegador
        header("location: index.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }
}

?>