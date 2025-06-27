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

$nome = "";
$descricao = "";
$link = "";
$evolucao = "";
$tipo1 = "";
$tipo2 = "";

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
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                                <input type="text" class="form-control" placeholder="Nome do Pokémon" name="nome" value=<?= $nome ?>>
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="text" class="form-control" placeholder="Descrição do pokémon" name="descricao" value=<?= $descricao ?>>
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="text" class="form-control" placeholder="Informe o link da imagem" name="link" value=<?= $link ?>>
                            </div>

                            <div class="mb-3 border-primary">
                                <input type="number" min="1" max="3" class="form-control" placeholder="Informe o estágio de evolução" name="evolucao" value=<?= $evolucao ?>>
                            </div>

                            <div class="mb-3 border-primary">
                                <select class="form-select" name="tipo1">
                                    <option value="">Selecione o Tipo</option>
                                    <option value="Normal" <?php if ($tipo1 == "Normal") {
                                                                echo "selected";
                                                            }; ?>>Normal</option>
                                    <option value="Fogo" <?php if ($tipo1 == "Fogo") {
                                                                echo "selected";
                                                            }; ?>>Fogo</option>
                                    <option value="Água" <?php if ($tipo1 == "Água") {
                                                                echo "selected";
                                                            }; ?>>Água</option>
                                    <option value="Elétrico" <?php if ($tipo1 == "Elétrico") {
                                                                    echo "selected";
                                                                }; ?>>Elétrico</option>
                                    <option value="Grama" <?php if ($tipo1 == "Grama") {
                                                                echo "selected";
                                                            }; ?>>Grama</option>
                                    <option value="Gelo" <?php if ($tipo1 == "Gelo") {
                                                                echo "selected";
                                                            }; ?>>Gelo</option>
                                    <option value="Lutador" <?php if ($tipo1 == "Lutador") {
                                                                echo "selected";
                                                            }; ?>>Lutador</option>
                                    <option value="Veneno" <?php if ($tipo1 == "Veneno") {
                                                                echo "selected";
                                                            }; ?>>Veneno</option>
                                    <option value="Terra" <?php if ($tipo1 == "Terra") {
                                                                echo "selected";
                                                            }; ?>>Terra</option>
                                    <option value="Voador" <?php if ($tipo1 == "Voador") {
                                                                echo "selected";
                                                            }; ?>>Voador</option>
                                    <option value="Psíquico" <?php if ($tipo1 == "Psiquico") {
                                                                    echo "selected";
                                                                }; ?>>Psíquico</option>
                                    <option value="Inseto" <?php if ($tipo1 == "Inseto") {
                                                                echo "selected";
                                                            }; ?>>Inseto</option>
                                    <option value="Fada" <?php if ($tipo1 == "Fada") {
                                                                echo "selected";
                                                            }; ?>>Fada</option>
                                    <option value="Dragão" <?php if ($tipo1 == "Dragão") {
                                                                echo "selected";
                                                            }; ?>>Dragão</option>
                                    <option value="Metal" <?php if ($tipo1 == "Metal") {
                                                                echo "selected";
                                                            }; ?>>Metal</option>
                                    <option value="Pedra" <?php if ($tipo1 == "Pedra") {
                                                                echo "selected";
                                                            }; ?>>Pedra</option>
                                    <option value="Fantasma" <?php if ($tipo1 == "Fantasma") {
                                                                    echo "selected";
                                                                }; ?>>Fantasma</option>
                                    <option value="Escuridão" <?php if ($tipo1 == "Escuridão") {
                                                                    echo "selected";
                                                                }; ?>>Escuridão</option>
                                </select>
                            </div>

                            <div class="mb-3 border-primary">
                                <select class="form-select" name="tipo2">
                                    <option value="">Selecione o Tipo</option>
                                    <option value="Normal" <?php if ($tipo2 == "Normal") {
                                                                echo "selected";
                                                            }; ?>>Normal</option>
                                    <option value="Fogo" <?php if ($tipo2 == "Fogo") {
                                                                echo "selected";
                                                            }; ?>>Fogo</option>
                                    <option value="Água" <?php if ($tipo2 == "Água") {
                                                                echo "selected";
                                                            }; ?>>Água</option>
                                    <option value="Elétrico" <?php if ($tipo2 == "Elétrico") {
                                                                    echo "selected";
                                                                }; ?>>Elétrico</option>
                                    <option value="Grama" <?php if ($tipo2 == "Grama") {
                                                                echo "selected";
                                                            }; ?>>Grama</option>
                                    <option value="Gelo" <?php if ($tipo2 == "Gelo") {
                                                                echo "selected";
                                                            }; ?>>Gelo</option>
                                    <option value="Lutador" <?php if ($tipo2 == "Lutador") {
                                                                echo "selected";
                                                            }; ?>>Lutador</option>
                                    <option value="Veneno" <?php if ($tipo2 == "Veneno") {
                                                                echo "selected";
                                                            }; ?>>Veneno</option>
                                    <option value="Terra" <?php if ($tipo2 == "Terra") {
                                                                echo "selected";
                                                            }; ?>>Terra</option>
                                    <option value="Voador" <?php if ($tipo2 == "Voador") {
                                                                echo "selected";
                                                            }; ?>>Voador</option>
                                    <option value="Psíquico" <?php if ($tipo2 == "Psiquico") {
                                                                    echo "selected";
                                                                }; ?>>Psíquico</option>
                                    <option value="Inseto" <?php if ($tipo2 == "Inseto") {
                                                                echo "selected";
                                                            }; ?>>Inseto</option>
                                    <option value="Fada" <?php if ($tipo2 == "Fada") {
                                                                echo "selected";
                                                            }; ?>>Fada</option>
                                    <option value="Dragão" <?php if ($tipo2 == "Dragão") {
                                                                echo "selected";
                                                            }; ?>>Dragão</option>
                                    <option value="Metal" <?php if ($tipo2 == "Metal") {
                                                                echo "selected";
                                                            }; ?>>Metal</option>
                                    <option value="Pedra" <?php if ($tipo2 == "Pedra") {
                                                                echo "selected";
                                                            }; ?>>Pedra</option>
                                    <option value="Fantasma" <?php if ($tipo2 == "Fantasma") {
                                                                    echo "selected";
                                                                }; ?>>Fantasma</option>
                                    <option value="Escuridão" <?php if ($tipo2 == "Escuridão") {
                                                                    echo "selected";
                                                                }; ?>>Escuridão</option>
                                    <option value="Não Tem" <?php if ($tipo2 == "Não tem") {
                                                                echo "selected";
                                                            }; ?>>Não Tem</option>
                                </select>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Enviar</button>
                                <button type="submit" formaction="card.php" class="btn btn-primary">Ir para o Card</button>
                            </div>
                        </form>
                        <div id="erros" class="border-primary rounded-4 border border-2" style="background-color: white;">
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