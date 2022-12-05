<?php

// linha de codigo que desabilita warnings e erro do php
// error_reporting(0);

include_once 'include/conexao.php';



// define que a variavel con ser DE USO GLOBAL
// global $con;

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

    
    $comando = $GLOBALS['conexao']->prepare($sql);

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

// ///////////////////////

// verifica se o email do usuario já esta cadastrado

function checkEmailUser($email){


    $sql = "SELECT email FROM tb_login WHERE email = '$email'";

    $comando = $GLOBALS['conexao']->prepare($sql);

    $comando->execute();

    $validaEmail = $comando -> fetchAll(PDO::FETCH_ASSOC);

    // retornar variavel retorno
    // quando utilizamos return = será retornado um valor pela função
    // quando utilizamos echo = é exibido uma informação na tela

    if($validaEmail != null){
        $retorno = array(
            'retorno'=>'erro',
            'mensagem'=> 'E-mail já cadastrado, tente outro e-mail!'
        );

// cria uma variavel que ira receber o array acima convertido em JSON
    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

// retorno em formato JSON
    echo $json;
    exit;

    }

}

function geraTokenUsuario($email){

    $sql = "SELECT id FROM tb_login WHERE email = '$email'";

    $comando = $GLOBALS['conexao']->prepare($sql);

    $comando->execute();

    $dados = $comando->fetch(PDO::FETCH_ASSOC);

    $IdUsuario = $dados['id'];

    // gera um token unico de ativação de conta de ususario
    $token = md5(uniqid($email,true));

    $sql = "INSERT INTO tb_usuarios_token(fk_id_usuarios,token) VALUES ($IdUsuario, '$token')";

    $comando = $GLOBALS['conexao']->prepare($sql);

    $comando->execute();

    // retorna o token gerado para ser enviado por email
    return $token;

}
