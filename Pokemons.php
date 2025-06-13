//coloque dentro da pasta"modelo"
<?php

class Pokemons
{
    private $nome;
    private string $descricao;
    private $link;
    private $tipo1;
    private $tipo2;
    private int $evolucao;

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     */
    public function setLink($link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of tipo1
     */
    public function getTipo1()
    {
        return $this->tipo1;
    }

    /**
     * Set the value of tipo1
     */
    public function setTipo1($tipo1): self
    {
        $this->tipo1 = $tipo1;

        return $this;
    }

    /**
     * Get the value of tipo2
     */
    public function getTipo2()
    {
        return $this->tipo2;
    }

    /**
     * Set the value of tipo2
     */
    public function setTipo2($tipo2): self
    {
        $this->tipo2 = $tipo2;

        return $this;
    }

    /**
     * Get the value of evolucao
     */
    public function getEvolucao(): int
    {
        return $this->evolucao;
    }

    /**
     * Set the value of evolucao
     */
    public function setEvolucao(int $evolucao): self
    {
        $this->evolucao = $evolucao;

        return $this;
    }

    public function salvar(PDO $conexao)
    {
        $sql = "INSERT INTO pokemon (nome, descricao, link, evolucao, tipo1, tipo2)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        return $stmt->execute([
            $this->getNome(),
            $this->getDescricao(),
            $this->getLink(),
            $this->getEvolucao(),
            $this->getTipo1(),
            $this->getTipo2()
        ]);
    }

    public function getVerificaTipo1()
    {
        if ($this->getTipo1() == 'No') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/normal.svg";
        } else if ($this->getTipo1() == 'Fo') {
            return  "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fire.svg";
        } else if ($this->getTipo1() == 'Ag') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/water.svg";
        } elseif ($this->getTipo1() == 'El') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/electric.svg";
        } elseif ($this->getTipo1() == 'Gr') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/grass.svg";
        } elseif ($this->getTipo1() == 'Ge') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ice.svg";
        } elseif ($this->getTipo1() == 'Lu') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fighting.svg";
        } elseif ($this->getTipo1() == 'Ve') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/poison.svg";
        } elseif ($this->getTipo1() == 'Te') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ground.svg";
        } elseif ($this->getTipo1() == 'Vo') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/flying.svg";
        } elseif ($this->getTipo1() == 'Ps') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/psychic.svg";
        } elseif ($this->getTipo1() == 'In') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/bug.svg";
        } elseif ($this->getTipo1() == 'Fa') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fairy.svg";
        } elseif ($this->getTipo1() == 'Dr') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dragon.svg";
        } elseif ($this->getTipo1() == 'Me') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/steel.svg";
        } elseif ($this->getTipo1() == 'Pe') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/rock.svg";
        } elseif ($this->getTipo1() == 'Ft') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ghost.svg";
        } elseif ($this->getTipo1() == 'Es') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dark.svg";
        }
    }
    public function getVerificaTipo2()
    {
        if ($this->getTipo2() == 'No') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/normal.svg";
        } else if ($this->getTipo2() == 'Fo') {
            return  "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fire.svg";
        } else if ($this->getTipo2() == 'Ag') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/water.svg";
        } elseif ($this->getTipo2() == 'El') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/electric.svg";
        } elseif ($this->getTipo2() == 'Gr') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/grass.svg";
        } elseif ($this->getTipo2() == 'Ge') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ice.svg";
        } elseif ($this->getTipo2() == 'Lu') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fighting.svg";
        } elseif ($this->getTipo2() == 'Ve') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/poison.svg";
        } elseif ($this->getTipo2() == 'Te') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ground.svg";
        } elseif ($this->getTipo2() == 'Vo') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/flying.svg";
        } elseif ($this->getTipo2() == 'Ps') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/psychic.svg";
        } elseif ($this->getTipo2() == 'In') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/bug.svg";
        } elseif ($this->getTipo2() == 'Fa') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fairy.svg";
        } elseif ($this->getTipo2() == 'Dr') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dragon.svg";
        } elseif ($this->getTipo2() == 'Me') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/steel.svg";
        } elseif ($this->getTipo2() == 'Pe') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/rock.svg";
        } elseif ($this->getTipo2() == 'Ft') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ghost.svg";
        } elseif ($this->getTipo2() == 'Es') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dark.svg";
        } else {
            return false;
        }
    }
    public function getGeraCard()
    {
        echo "<div class='d-flex justfy-content-center align-items-center vh-100'>";
        echo "<div class='rounded-4 border border-5 border-primary'style='width: 30rem; margin: 20px; background-color: white'>";
        echo "Pokémon:" . $this->getNome() . "<br><br>";
        echo "Descrição: " . $this->getDescricao() . "<br><br>";
        echo "Fase evolutíva: " . $this->getEvolucao() . "<br><br>";
        echo "Tipo 1: <img style='width='50' height='50';  src='" . $this->getVerificaTipo1() . "' />";
        if ($this->getVerificaTipo2()) {
            echo "Tipo 2: <img style='width='50' height='50'; src='" . $this->getVerificaTipo2() . "' /><br><br>";
        } else {
            echo "<br>";
        }
        echo "<hr><img style='width: 100%; height: auto;' src='" . $this->getLink() . "' /><br><br>";
        echo "<a class='mx-5' href='formulario.php' style = 'color: black;'>Cadastrar outro Pokémon</a>";
        echo "</div>";
        echo "</div>";
    }
}
