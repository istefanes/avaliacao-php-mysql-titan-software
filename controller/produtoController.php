<?php


class ProdutoController {


    public function index() {

        $produto = new Produto();

        $_REQUEST['dados'] = $produto->getTodos();

        require_once 'view/produto/index.php';
    }


    public function visualizar() {

        $produto = new Produto();

        if ( isset($_REQUEST['id']) && $_REQUEST['id'] > 0 ) {
            $produto->carregar($_REQUEST['id']); // Carrega os dados se estiver visualizando um produto já cadastrado
        }

        $_REQUEST['produto'] = $produto;

        require_once 'view/produto/form.php';
    }


    public function cadastrar() {

        $produto = new Produto();

        $produto->setNome($_REQUEST['nome']);
        $produto->setCor($_REQUEST['cor']);
        $produto->setPreco($_REQUEST['preco']);

        $produto->inserir();


        // Cria um json confirmando a inserção
        $a_retorno = [
            'status' => 'OK',
            'redirecionar' => URL_RAIZ . PRODUTO_BUSCAR
        ];

        echo json_encode($a_retorno);
    }


    public function atualizar() {

        $produto = new Produto();

        $produto->setIdprod($_REQUEST['idprod']);
        $produto->setNome($_REQUEST['nome']);
        $produto->setCor($_REQUEST['cor']);
        $produto->setPreco($_REQUEST['preco']);

        if ( !$produto->atualizar() ) {
            
            // Se não conseguir atualizar, retorna a mensagem gerada pela classe
            $a_retorno = [
                'status' => 'FALHA',
                'mensagem' => $produto->getMensagemStatus()
            ];

            echo json_encode($a_retorno);
            exit;
        }


        // Cria um json confirmando a atualização
        $a_retorno = [
            'status' => 'OK',
            'redirecionar' => URL_RAIZ . PRODUTO_BUSCAR
        ];

        echo json_encode($a_retorno);
    }


    public function excluir() {

        // Remove o produto
        $produto = new Produto();
        $produto->setIdprod($_REQUEST['id']);
        $produto->remover();


        // Volta para o index do cadastro
        header('Location: ' . URL_RAIZ . PRODUTO_BUSCAR);
    }
}


?>