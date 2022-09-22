<?php

include 'include/conexao.php';

try{

$id = $_POST['id'];

$sql = "DELETE FROM tb_login where id = $id";

$comando = $conexao->prepare($sql);

$comando->execute();

// cria um array para armazenar a mensagem de erro
$retorno = array(
    'retorno'=>'ok',
    'mensagem'=> 'Usuário Removido!'
);

// cria uma variavel que ira receber o array acima convertido em JSON
$json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

// retorno em formato JSON
echo $json;

}catch(PDOException $erro){

    // cria um array para armazenar a mensagem de erro
    $retorno = array(
        'retorno'=>'erro',
        'mensagem'=>$erro->getMessage()
    );

$json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

echo $json;

}

// fechar a conexão
$conexao = null;

?>