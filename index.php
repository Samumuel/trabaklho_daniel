<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("modelo/Pokemons.php");
require_once("util/Conexao.php");

$con = Conexao::getConexao();

$sql = "SELECT * FROM pokemon";
$stm = $con->prepare($sql);
$stm->execute();
$pokemons = $stm->fetchAll();

$msgErro = "";

if (isset($_POST["nome"])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];
    $evolucao = $_POST['evolucao'];
    $tipo1 = $_POST['tipo1'];
    $tipo2 = $_POST['tipo2'];

    //Validar os dados  

    $erros = array();
    if (! $nome) {
        array_push($erros, 'Informe um nome');
    } else {
        $sql = "SELECT id FROM pokemon WHERE nome = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$nome]);
        $result = $stm->fetchAll();

        if (count($result) > 0) {
            array_push($erros, "Já existe este pokémon!");
        }
    }
    if (! $descricao) {
        array_push($erros, 'Informe a Descrição!');
    }
    if (! $link) {
        array_push($erros, 'Informe o Link!');
    }
    if (! $evolucao) {
        array_push($erros, 'Informe a evolução!');
    }
    if (! $tipo1) {
        array_push($erros, 'Informe o tipo 1!');
    }
    if (! $tipo2) {
        array_push($erros, 'Informe o tipo 2!');
    }
    if (count($erros) == 0) {
        //Inserir as informações na base de dados
        $sql = "INSERT INTO pokemon (nome, descricao, link, evolucao, tipo1, tipo2) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $con->prepare($sql);
        $stm->execute([$nome, $descricao, $link, $evolucao, $tipo1, $tipo2]);

        //Redirecionar para a mesma pagina a fim de limpar o buffer do navegador
        header("location: index.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }
    $pokemon = new Pokemons(
        $_POST["nome"], 
        $_POST["descricao"], 
        $_POST["link"], 
        $_POST["tipo1"], 
        $_POST["tipo2"], 
        $_POST["evolucao"]
    );

    if (empty($erros)) {
        $pokemon->salvar();
        header("Location: index.php"); // evita reenvio duplicado
        exit;
    }

    if ($pokemon->salvar($con)) {
        header("Location: index.php");
        exit;
    } else {
        $msgErro = "Erro ao salvar no banco de dados.";
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="text-center d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="container">
            <div class="row justify-content-center ">
                <h1>Listagem</h1>
                <table border="2" class="border-primary" style="background-color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Evolução</th>
                        <th>Tipo 1</th>
                        <th>Tipo 2</th>
                    </tr>

                    <?php foreach ($pokemons as $pk):   ?>
                    <tr>
                        <td><?= $pk["id"] ?></td>
                        <td><?= $pk["nome"] ?></td>
                        <td><?= $pk["descricao"] ?></td>
                        <td><?= $pk["evolucao"] ?></td>
                        <td><?= $pk["tipo1"] ?></td>
                        <td><?= $pk["tipo2"] ?></td>
                        <td><a href="excluir.php?excluir=<?= $pk["id"] ?>">Excluir</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <div class="col-md-6 col-lg-4">
                    <main class="form-signin w-100 m-auto text-center">

                        <img class="mb-3" src="https://www.freeiconspng.com/uploads/pokeball-pokemon-ball-picture-11.png" alt="Pokebola" width="72" height="72">
                        <h1 class="h3 mb-3 fw-normal border-primary">Cadastre o Pokémon</h1>
                        <form action="" method="POST">
                            <div class="mb-3 border-primary">
                                <input type="text" class="form-control" placeholder="Nome do Pokémon" name="nome">
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="text" class="form-control" placeholder="Descrição do pokémon" name="descricao">
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="text" class="form-control" placeholder="Informe o link da imagem" name="link">
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="number" min="1" max="3" class="form-control" placeholder="Informe o estágio de evolução" name="evolucao">
                            </div>

                            <div class="mb-3 border-primary">
                                <select class="form-select" name="tipo1">
                                    <option value="">Selecione o tipo</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Fogo">Fogo</option>
                                    <option value="Água">Água</option>
                                    <option value="Elétrico">Elétrico</option>
                                    <option value="Grama">Grama</option>
                                    <option value="Gelo">Gelo</option>
                                    <option value="Lutador">Lutador</option>
                                    <option value="Veneno">Veneno</option>
                                    <option value="Terra">Terra</option>
                                    <option value="Voador">Voador</option>
                                    <option value="Psíquico">Psíquico</option>
                                    <option value="Inseto">Inseto</option>
                                    <option value="Fada">Fada</option>
                                    <option value="Dragão">Dragão</option>
                                    <option value="Metal">Metal</option>
                                    <option value="Pedra">Pedra</option>
                                    <option value="Fantasma">Fantasma</option>
                                    <option value="Escuridão">Escuridão</option>
                                </select>
                            </div>

                            <div class="mb-3 border-primary">
                                <select class="form-select" name="tipo2">
                                    <option value="">Selecione o tipo</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Fogo">Fogo</option>
                                    <option value="Água">Água</option>
                                    <option value="Elétrico">Elétrico</option>
                                    <option value="Grama">Grama</option>
                                    <option value="Gelo">Gelo</option>
                                    <option value="Lutador">Lutador</option>
                                    <option value="Veneno">Veneno</option>
                                    <option value="Terra">Terra</option>
                                    <option value="Voador">Voador</option>
                                    <option value="Psíquico">Psíquico</option>
                                    <option value="Inseto">Inseto</option>
                                    <option value="Fada">Fada</option>
                                    <option value="Dragão">Dragão</option>
                                    <option value="Metal">Metal</option>
                                    <option value="Pedra">Pedra</option>
                                    <option value="Fantasma">Fantasma</option>
                                    <option value="Escuridão">Escuridão</option>
                                    <option value="Nenhum">Não Tem</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Enviar</button>
                                <button type="submit" formaction="card.php" class="btn btn-primary">Ir para o Card</button>
                            </div>
                        </form>
                        <div id="erros" style="color: red;">
                            <?=
                            $msgErro;
                            ?>
                        </div>
                        <script src="js/validacao.js">
                        </script>
                    </main>
                </div>
            </div>
        </div>


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
