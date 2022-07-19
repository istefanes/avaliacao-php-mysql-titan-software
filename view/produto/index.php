<?php

    // Recebe o request com os dados dos produtos e preços
    $produtos = $_REQUEST['dados'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PRODUTOS</title>
        <link rel="stylesheet" href="css/layout.css">
        <script type="text/javascript" src="js/mascaras.js"></script>
    </head>

    <body>
        <h1>Produtos Cadastrados</h1>


        <form method="get" class="form-busca">

            <label for="nbusca_ome">Nome:</label>
            <br>
            <input type="text" id="busca_nome" name="busca_nome" value="<?=@$_GET['busca_nome']?>">
            <br><br>

            <label for="busca_cor">Côr:</label>
            <br>
            <select name="busca_cor" id="busca_cor">
                <?php
                    // Cria um array com as opções de cores disponíveis
                    $a_cores = array('','AMARELO','AZUL','VERMELHO','VERDE');

                    // Percorre o array das cores criando os itens do select
                    foreach ($a_cores as $cor) {

                        $selecionado = '';
                        // Se for a côr buscada, seleciona no select
                        if ( @$_GET['busca_cor'] == $cor ) {
                            $selecionado = 'selected';
                        }

                        ?>
                            <option <?=$selecionado?> value="<?=$cor?>"><?=$cor?></option>
                        <?php
                    }
                ?>
            </select>
            <br><br>

            <label for="busca_preco">Preço (R$):</label>
            <br>
            <input type="text" id="busca_preco" name="busca_preco" value="<?=@$_GET['busca_preco']?>" onkeyup="mascara_valor(this)">
            <br><br>

            <label for="busca_filtro_preco">Filtro Preço:</label>
            <br>
            <select name="busca_filtro_preco" id="busca_filtro_preco">
                <?php
                    // Cria um array com as opções disponíveis
                    $a_opcoes = array('MAIOR','MENOR','IGUAL');

                    // Percorre o array criando os itens do select
                    foreach ($a_opcoes as $opcao) {

                        $selecionado = '';
                        // Se for a opção buscada, seleciona no select
                        if ( @$_GET['busca_filtro_preco'] == $opcao ) {
                            $selecionado = 'selected';
                        }

                        ?>
                            <option <?=$selecionado?> value="<?=$opcao?>"><?=$opcao?></option>
                        <?php
                    }
                ?>
            </select>
            <br><br>

            <!-- Mantem o controle da rota ao fazer o filtro de buscas -->
            <input type="hidden" id="r" name="r" value="<?=PRODUTO_BUSCAR?>">

            <input type="submit" value="Buscar" class="botao botao-buscar">

            <a href="<?=URL_RAIZ . PRODUTO_VISUALIZAR?>" class="botao botao-inserir">Novo Produto</a>

        </form>
        <br><br><br>



        <table>
            <tr>
                <th class="alinha-centro">ID</th>
                <th class="alinha-esquerda">NOME</th>
                <th class="alinha-esquerda">CÔR</th>
                <th class="alinha-direita">PREÇO ORIGINAL</th>
                <th class="alinha-direita">DESCONTO</th>
                <th class="alinha-direita">PREÇO</th>
                <th></th>
                <th></th>
            </tr>
            <?php

                // Lista todos os produtos localizados
                foreach ($produtos as $produto) {

                    // Esse tratamento serve para exibir a celula de desconto vazia caso não tenha desconto
                    if ( $produto->getDescontoPorcentagem() > 0 ) {
                        $string_desconto = "R$ ".number_format($produto->getDescontoReais(), 2, ',', '.')." (".$produto->getDescontoPorcentagem()."%)";
                    } else {
                        $string_desconto = '';
                    }

                    ?>
                        <tr>
                            <td class="alinha-centro"><?=$produto->getIdprod()?></td>
                            <td class="alinha-esquerda"><?=$produto->getNome()?></td>
                            <td class="alinha-esquerda"><?=$produto->getCor()?></td>
                            <td class="alinha-direita">R$ <?=number_format($produto->getPreco(), 2, ',', '.')?></td>
                            <td class="alinha-direita"><?=$string_desconto?></td>
                            <td class="alinha-direita">R$ <?=number_format($produto->getPreco() - $produto->getDescontoReais(), 2, ',', '.')?></td>
                            <td class="coluna-acao">
                                <a href="<?=URL_RAIZ . PRODUTO_VISUALIZAR . '&id=' . $produto->getIdprod()?>">
                                    <img src="img/editar.png" alt="Editar Resgistro" title="Editar Resgistro" class="botao-editar">
                                </a>
                            </td>
                            <td class="coluna-acao">
                                <a href="<?=URL_RAIZ.PRODUTO_EXCLUIR . '&id=' . $produto->getIdprod()?>"  onclick="return confirm('Confirma a exclusão do registro?')">
                                    <img src="img/excluir.png" alt="Excluir Resgistro" title="Excluir Resgistro" class="botao-excluir">
                                </a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </body>

</html>