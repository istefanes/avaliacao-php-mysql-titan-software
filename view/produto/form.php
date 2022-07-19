<?php
    // Recebe o request com os dados do produto
    $produto = $_REQUEST['produto'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PRODUTOS</title>
        <link rel="stylesheet" href="css/layout.css">
        <script type="text/javascript" src="js/ajaxFormulario.js"></script>
        <script type="text/javascript" src="js/mascaras.js"></script>
    </head>

    <body>

        <h1><?=$produto->getIdprod() > 0 ? 'Produto: '.$produto->getIdprod() : 'Cadastrar Novo Produto'?></h1>


        <form action="<?=$produto->getIdprod() > 0 ? URL_RAIZ . PRODUTO_ATUALIZAR : URL_RAIZ . PRODUTO_CADASTRAR?>" method="post">

            <label for="nome">Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" value="<?=$produto->getNome()?>">
            <br><br>

            <label for="cor">Côr:</label>
            <br>
            <select name="cor" id="cor">
                <?php
                    // Cria um array com as opções de cores disponíveis
                    $a_cores = array('','AMARELO','AZUL','VERMELHO','VERDE');

                    // Percorre o array das cores criando os itens do select
                    foreach ($a_cores as $cor) {

                        $selecionado = '';
                        // Se for a côr escolhida, seleciona no select
                        if ( $produto->getCor() == $cor ) {
                            $selecionado = 'selected';
                        }

                        ?>
                            <option <?=$selecionado?> value="<?=$cor?>"><?=$cor?></option>
                        <?php
                    }
                ?>
            </select>
            <br><br>

            <label for="preco">Preço (R$):</label>
            <br>
            <input type="text" id="preco" name="preco" value="<?=number_format($produto->getPreco(), 2, ',', '.')?>" onkeyup="mascara_valor(this)">
            <br><br>

            <input type="hidden" id="idprod" name="idprod" value="<?=$produto->getIdprod()?>">


            <a href="<?=URL_RAIZ . PRODUTO_BUSCAR?>" class="botao botao-voltar">Voltar</a>
            <input type="submit" value="<?=$produto->getIdprod() > 0 ? 'Atualizar' : 'Cadastrar'?>" class="botao botao-cadastrar">

        </form>

        <!-- Div usada para receber o retorno da chamada ajax -->
        <div id="div_log_js"></div>

    </body>

</html>