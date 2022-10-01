<?php


// Arquivo de funções genericas para que poder ser reutilizadas em outras pags

// função que valida o preenchimento de uma variavel
function validaCampoVazio($campo,$nomeCampo){
    

// exemplo simples de validação de preenchimento de variavel

    if($campo == ''){
   
        $retorno = array(
                        'retorno'=>'erro',
                        'mensagem'=> 'Preencha o campo '.$nomeCampo.'!'
                    );

        // cria uma variavel que ira receber o array acima convertido em JSON
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        // retorno em formato JSON
        echo $json;
        // encerra o script
        exit;
        }
    
}

// função generica que executa uma query de adicionar, atualizar e deletar registros
function insertUpdateDelele($sql,$mensagemretorno){

    include_once 'include/conexao.php';

    $comando = $conexao->prepare($sql);

     $comando->execute();

    // cria um array para armazenar a mensagem de erro
    $retorno = array(
                    'retorno'=>'ok',
                    'mensagem'=> $mensagemretorno
                );

    // cria uma variavel que ira receber o array acima convertido em JSON
    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    // retorno em formato JSON
    echo $json;

}

function pdocatch($erro){
     // cria um array para armazenar a mensagem de erro
     $retorno = array(
        'retorno'=>'erro',
        'mensagem'=>$erro->getMessage()
    );

$json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

echo $json;
}

?>