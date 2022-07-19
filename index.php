<?php
// Neste arquivo é feito o roteamento das requisições feitas dentro da aplicação

require_once 'autoload.php';




// Define qual a rota padrão
// Neste caso, vai exibir a listagem dos produtos cadastrados quando abrir a aplicação, mas poderia ser um dashboard com alguns relatórios por exemplo
$rota = PRODUTO_BUSCAR;// Define a rota padrão


// Verifica se alguma rota foi informada
if ( isset($_GET['r']) && $_GET['r']!='' ) {
    $rota = $_GET['r'];
}



// Quebra a string da rota escolhida em um array
$a_rota = explode('/',$rota);

// Se definir uma classe
if ( isset($a_rota[0]) && $a_rota[0]!='' ) {
    $classe_controller = $a_rota[0];
}

// Se definir uma ação
if ( isset($a_rota[1]) && $a_rota[1]!='' ) {
    $acao = $a_rota[1];
} else {
    $acao = 'index';
}



// Completa o nome da classe do controlador
$classe_controller .= 'Controller';

// Por fim, cria uma instância do controlador e executa o método escolhido
$controlador = new $classe_controller();
$controlador->$acao();


?>