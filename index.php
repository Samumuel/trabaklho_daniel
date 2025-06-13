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
        $sql = "INSERT INTO livros (nome, descricao, link, evolucao, tipo, tipo2) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $con->prepare($sql);
        $stm->execute([$nome, $descricao, $link, $evolucao, $tipo, $tipo2]);

        //Redirecionar para a mesma pagina a fim de limpar o buffer do navegador
        header("location: index.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }
    $pokemon = new Pokemons();
    $pokemon->setNome($nome)
        ->setDescricao($descricao)
        ->setLink($link)
        ->setEvolucao((int)$evolucao)
        ->setTipo1($tipo1)
        ->setTipo2($tipo2);

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
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <main class="form-signin w-100 m-auto text-center">

                        <h1>Listagem</h1>

                        <table border="1">
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
                                    <td><a href="excluir.php?excluir=<?= $l["id"] ?>">Excluir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <img class="mb-3" src="https://www.freeiconspng.com/uploads/pokeball-pokemon-ball-picture-11.png" alt="Pokebola" width="72" height="72">
                        <h1 class="h3 mb-3 fw-normal">Cadastre o Pokémon</h1>
                        <form action="card.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nome do Pokémon" name="nome">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Descrição do pokémon" name="descricao">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Informe o link da imagem" name="link">
                            </div>

                            <div class="mb-3">
                                <input type="number" min="1" max="3" class="form-control" placeholder="Informe o estágio de evolução" name="evolucao">
                            </div>

                            <div class="mb-3">
                                <select class="form-select" name="tipo1">
                                    <option value="">Selecione o tipo</option>
                                    <option value="No">Normal</option>
                                    <option value="Fo">Fogo</option>
                                    <option value="Ag">Água</option>
                                    <option value="El">Elétrico</option>
                                    <option value="Gr">Grama</option>
                                    <option value="Ge">Gelo</option>
                                    <option value="Lu">Lutador</option>
                                    <option value="Ve">Veneno</option>
                                    <option value="Te">Terra</option>
                                    <option value="Vo">Voador</option>
                                    <option value="Ps">Psíquico</option>
                                    <option value="In">Inseto</option>
                                    <option value="Fa">Fada</option>
                                    <option value="Dr">Dragão</option>
                                    <option value="Me">Metal</option>
                                    <option value="Pe">Pedra</option>
                                    <option value="Ft">Fantasma</option>
                                    <option value="Es">Escuridão</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" name="tipo2">
                                    <option value="">Selecione o tipo</option>
                                    <option value="No">Normal</option>
                                    <option value="Fo">Fogo</option>
                                    <option value="Ag">Água</option>
                                    <option value="El">Elétrico</option>
                                    <option value="Gr">Grama</option>
                                    <option value="Ge">Gelo</option>
                                    <option value="Lu">Lutador</option>
                                    <option value="Ve">Veneno</option>
                                    <option value="Te">Terra</option>
                                    <option value="Vo">Voador</option>
                                    <option value="Ps">Psíquico</option>
                                    <option value="In">Inseto</option>
                                    <option value="Fa">Fada</option>
                                    <option value="Dr">Dragão</option>
                                    <option value="Me">Metal</option>
                                    <option value="Pe">Pedra</option>
                                    <option value="Ft">Fantasma</option>
                                    <option value="Es">Escuridão</option>
                                    <option value="Nenhum">Não Tem</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Enviar</button>
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
