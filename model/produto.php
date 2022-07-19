<?php

class Produto extends Preco {

    private $bd;
    private $idprod;
    private $nome;
    private $cor;
    private $mensagem_status;



    /* Cria uma instância da conexão com o banco de dados ao inicializar o objeto */
    public function __construct() {

        $this->bd = Conexao::getInstancia();
    }


    /* Faz a inserção dos dados no banco */
    public function inserir() {

        // Insere o produto no banco de dados
        $this->bd->query("INSERT INTO produtos SET nome='".$this->getNome()."', cor='".$this->getCor()."' ");

        // Captura o id co o qual o produto foi registrado
        $idprod = $this->bd->lastInsertId();

        // Faz a inserção do preço no banco de dados
        $this->bd->query("INSERT INTO preco SET preco='".$this->getPreco()."', idpreco='".$idprod."' ");

        // Captura o id do registro que foi inserido
        $this->setIdprod($idprod);
    }

    /* Atualiza o registro no banco */
    public function atualizar() {

        // Carrega o registro do produto para validar se houve alguma tentativa de alteração da côr
        $sql_produto = $this->bd->query("SELECT cor FROM produtos WHERE idprod='".$this->getIdprod()."' LIMIT 1");
        $a_produto   = $sql_produto->fetch(PDO::FETCH_ASSOC);

        if ( $a_produto['cor'] != $this->getCor() ) {
            // Se for feita tentativa de alteração de preço, emite um alerta e não faz a atualização
            $this->mensagem_status = 'ATENÇÃO: A côr do produto não pode ser alterada!';

            return false;
        }


        // Atualiza o registro do produto
        $this->bd->query("UPDATE produtos SET nome='".$this->getNome()."', cor='".$this->getCor()."' WHERE idprod=".$this->getIdprod());

        // Atualiza o registro do preço. Detalhe: o id do preço é o mesmo do produto
        $this->bd->query("UPDATE preco SET preco='".$this->getPreco()."' WHERE idpreco=".$this->getIdprod());

        // Retorna verdadeiro confirmando a conclusão da operação    
        return true;
    }

    /* Faz a remoção do registro no banco de dados */
    public function remover() {

        // Remove o registro do produto
        $this->bd->query("DELETE FROM produtos WHERE idprod=".$this->getIdprod());

        // Remove o registro do preço
        $this->bd->query("DELETE FROM preco WHERE idpreco=".$this->getIdprod());
    }



    public function setIdprod($idprod) {
        $this->idprod = $idprod;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }



    public function getIdprod() {
        return $this->idprod;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCor() {
        return $this->cor;
    }

    /* Retorna todos os produtos cadastrados */
    public function getTodos() {

        $extra_sql = '';

        // Verifica se foi feito algum filtro
        if ( isset($_GET['busca_nome']) && $_GET['busca_nome']!='' ) {

            $extra_sql .= " AND nome LIKE '%$_GET[busca_nome]%' ";
        }

        if ( isset($_GET['busca_cor']) && $_GET['busca_cor']!='' ) {

            $extra_sql .= " AND cor = '$_GET[busca_cor]' ";
        }

        if ( isset($_GET['busca_preco']) && $_GET['busca_preco']!='' ) {

            $preco = $_GET['busca_preco'];

            // Faz a converção do formato brasileiro para o decimal
            $preco = str_replace('.', '', $preco);
            $preco = str_replace(',', '.', $preco);

            // Garante que vai estar no formato numerico para fazer o tratamento das casas decimais
            $preco = floatval($preco);
            // Deixa apenas com duas cadas decimais
            $preco = number_format($preco, 2, '.', '');


            switch ( $_GET['busca_filtro_preco'] ) {
                case 'MAIOR':
                    $extra_sql .= " AND preco > '$preco' ";
                    break;

                case 'MENOR':
                    $extra_sql .= " AND preco < '$preco' ";
                    break;

                case 'IGUAL':
                    $extra_sql .= " AND preco = '$preco' ";
                    break;
            }
        }


        // O relacionamento do produto com o preço foi feito inserindo os dois registros com o mesmo id, já que não tem uma chave estrangeira na tabela de preço
        $sql = $this->bd->query("SELECT * FROM produtos,preco WHERE idpreco=idprod $extra_sql");


        $retorno = array();
        while ( $a_produto = $sql->fetch(PDO::FETCH_ASSOC) ) {

            // Cria a instancia e importa os dados obtidos
            $produto = new Produto();
            $produto->importar($a_produto);

            // Insere os objetos dentro de um array para serem processados na view
            $retorno[] = $produto;
        }


        return $retorno;
    }

    function getMensagemStatus() {
        return $this->mensagem_status;
    }




    /* Recebe um array com os dados do produto e carrega os parâmetros */
    public function importar($a_dados = array()) {

        foreach ($a_dados as $campo => $valor) {
            $metodo = 'set'.ucfirst($campo); // Cria o metodo set equivalente ao parâmetro a ser importado

            $this->$metodo($valor); // Executa o metodo set importando o dado
        }
    }


    /* Carrega os dados do produto do banco de dados e adiciona suas prorpiedades no objeto */
    public function carregar($id) {

        $sql_produto = $this->bd->query("SELECT * FROM produtos WHERE idprod='$id' LIMIT 1");
        $a_produto   = $sql_produto->fetch(PDO::FETCH_ASSOC);

        $sql_preco = $this->bd->query("SELECT * FROM preco WHERE idpreco='$id' LIMIT 1");
        $a_preco   = $sql_preco->fetch(PDO::FETCH_ASSOC);

        // Une os dados em um só array para ser importado
        $a_dados = array_merge($a_produto,$a_preco);

        $this->importar($a_dados);
    }
}





?>