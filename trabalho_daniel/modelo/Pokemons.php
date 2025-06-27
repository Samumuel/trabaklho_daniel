<?php

//coloque dentro da pasta"modelo"

class Pokemons
{
    private $nome;
    private $descricao;
    private $link;
    private $tipo1;
    private $tipo2;
    private $evolucao;

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao($descricao): self
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
    public function getEvolucao()
    {
        return $this->evolucao;
    }

    /**
     * Set the value of evolucao
     */
    public function setEvolucao($evolucao): self
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
        if ($this->getTipo1() == 'Normal') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/normal.svg";
        } else if ($this->getTipo1() == 'Fogo') {
            return  "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fire.svg";
        } else if ($this->getTipo1() == 'Água') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/water.svg";
        } elseif ($this->getTipo1() == 'Elétrico') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/electric.svg";
        } elseif ($this->getTipo1() == 'Grama') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/grass.svg";
        } elseif ($this->getTipo1() == 'Gelo') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ice.svg";
        } elseif ($this->getTipo1() == 'Lutador') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fighting.svg";
        } elseif ($this->getTipo1() == 'Veneno') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/poison.svg";
        } elseif ($this->getTipo1() == 'Terra') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ground.svg";
        } elseif ($this->getTipo1() == 'Voador') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/flying.svg";
        } elseif ($this->getTipo1() == 'Psíquico') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/psychic.svg";
        } elseif ($this->getTipo1() == 'Inseto') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/bug.svg";
        } elseif ($this->getTipo1() == 'Fada') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fairy.svg";
        } elseif ($this->getTipo1() == 'Dragão') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dragon.svg";
        } elseif ($this->getTipo1() == 'Metal') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/steel.svg";
        } elseif ($this->getTipo1() == 'Pedra') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/rock.svg";
        } elseif ($this->getTipo1() == 'Fantasma') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ghost.svg";
        } elseif ($this->getTipo1() == 'Escuridão') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dark.svg";
        }
    }
    public function getVerificaTipo2()
    {
        if ($this->getTipo2() == 'Normal') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/normal.svg";
        } else if ($this->getTipo2() == 'Fogo') {
            return  "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fire.svg";
        } else if ($this->getTipo2() == 'Água') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/water.svg";
        } elseif ($this->getTipo2() == 'Elétrico') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/electric.svg";
        } elseif ($this->getTipo2() == 'Grama') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/grass.svg";
        } elseif ($this->getTipo2() == 'Gelo') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ice.svg";
        } elseif ($this->getTipo2() == 'Lutador') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fighting.svg";
        } elseif ($this->getTipo2() == 'Veneno') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/poison.svg";
        } elseif ($this->getTipo2() == 'Terra') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ground.svg";
        } elseif ($this->getTipo2() == 'Voador') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/flying.svg";
        } elseif ($this->getTipo2() == 'Psíquico') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/psychic.svg";
        } elseif ($this->getTipo2() == 'Inseto') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/bug.svg";
        } elseif ($this->getTipo2() == 'Fada') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/fairy.svg";
        } elseif ($this->getTipo2() == 'Dragão') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dragon.svg";
        } elseif ($this->getTipo2() == 'Metal') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/steel.svg";
        } elseif ($this->getTipo2() == 'Pedra') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/rock.svg";
        } elseif ($this->getTipo2() == 'Fantasma') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/ghost.svg";
        } elseif ($this->getTipo2() == 'Escuridão') {
            return "https://www.lmcorp.com.br/arquivos/img/assets/tcg_2/icons/types/dark.svg";
        } else {
            return false;
        }
    }
    public function getGeraCard()
    {
        $html = "<div class='card rounded-4 border border-3 border-primary' style='width: 18rem; background-color: white'>";
        $html .= "<div class='card-body'>";
        $html .= "<h5 class='card-title'>Pokémon: " . $this->getNome() . "</h5>";
        $html .= "<p class='card-text'>Descrição: " . $this->getDescricao() . "</p>";
        $html .= "<p class='card-text'>Fase evolutíva: " . $this->getEvolucao() . "</p>";
        $html .= "<p class='card-text'>";
        $html .= "Tipo 1: <img width='40' height='40' src='" . $this->getVerificaTipo1() . "' />";
        if ($this->getVerificaTipo2() != false) {
            $html .= " Tipo 2: <img width='40' height='40' src='" . $this->getVerificaTipo2() . "' />";
        }
        $html .= "</p>";
        $html .= "</div>";
        $html .= "<img class='card-img-bottom' src='" . $this->getLink() . "' alt='Imagem do Pokémon'>";
        $html .= "<div class='card-body text-center'>";
        $html .= "</div>";
        $html .= "</div>";
    
        return $html;
    }
}
