

/* Só executa o código, após o navegador concluir o carregamento da página html */
window.onload = function () {

    var formulario = document.querySelector('form');

    formulario.addEventListener('submit', function(e) {

        e.preventDefault(); // Interrompe o envio do formulário
    
        var url      = this.action; // Captura a url usada no action do formulário
        var formData = new FormData(this); // Captura os dados dos campos do formulário
        var ajax     = new XMLHttpRequest();
    
        ajax.open("POST", url, true);
        ajax.onload = function() {
    
            if ( ajax.status == 200 ) { // Se a requisição foi feita com sucesso

                try {
                    
                    var resposta = JSON.parse(ajax.responseText); // Captura a resposta do servidor

                    if ( resposta.status == 'OK' ) {
                        // Se estiver tudo ok, redireciona para a url retornada
                        window.location.href = resposta.redirecionar;

                    } else {
                        // Se estiver com alguma pendência, exibe a mensagem retornada
                        alert(resposta.mensagem);
                    }

                } catch(err) {
                    
                    alert('ERRO: Falha ao processar a requisição!');

                    // Gera um pequeno debug no log para casso de erros
                    console.log('----------RESPOSTA REQUISICAO----------');
                    console.log(ajax.responseText);
                    console.log('----------ERRO SCRIPT----------');
                    console.log(err);
                }
    
            } else {
                // Se houver falha na requisição

                alert('ERRO: Falha ao enviar a requisição!');
            }
        };

        ajax.send(formData);
    });
}

