<?php


class Preco {

    private $idpreco;
    private $preco;



    public function setIdpreco($idpreco) {
        $this->idpreco = $idpreco;
    }

    public function setPreco($preco) {

        // Verifica se está no formato brasileiro
        if ( strpos($preco, ',') ) {

            // Faz a converção do formato brasileiro para o decimal
            $preco = str_replace('.', '', $preco);
            $preco = str_replace(',', '.', $preco);
        }

        // Garante que vai estar no formato numerico para fazer o tratamento das casas decimais
        $preco = floatval($preco);
        // Deixa apenas com duas cadas decimais
        $preco = number_format($preco, 2, '.', '');

        $this->preco = $preco;
    }



    public function getIdpreco() {
        return $this->idpreco;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getDescontoPorcentagem() {

        // Porcentagem de desconto padrão. Neste caso, sem desconto
        $desconto_porcentagem = 0;

        // Estabelece a porcentagem de descontos de acordo com a regra de negócios
        if ( $this->getCor() == 'VERMELHO' && $this->getPreco() > 50 ) {
            $desconto_porcentagem = 5;

        } elseif ( $this->getCor() == 'AMARELO' ) {
            $desconto_porcentagem = 10;

        } elseif ( $this->getCor() == 'AZUL' || $this->getCor() == 'VERMELHO' ) {
            $desconto_porcentagem = 20;

        }

        return $desconto_porcentagem;
    }

    public function getDescontoReais() {

        $desconto_porcentagem = $this->getDescontoPorcentagem();
        $desconto_reais       = 0;
        $preco                = $this->getPreco();

        // Calcula o desconto concedido em reais utilizando regra de três
        if ( $desconto_porcentagem > 0 && $preco > 0 ) {
            $desconto_reais = ($preco * $desconto_porcentagem) / 100;
        }

        return $desconto_reais;
    }
}


?>