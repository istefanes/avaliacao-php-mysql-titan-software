<?php
// Arquivo de autoload simplificado, feito para automatizar e centralizar as inclusões dos arquivos de configurações e classes


require_once 'configuracoes/configuracao.php';
require_once 'configuracoes/rotas.php';

require_once 'model/conexao.php';
require_once 'model/preco.php';
require_once 'model/produto.php';

require_once 'controller/produtoController.php';

?>