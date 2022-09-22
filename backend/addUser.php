<?php

// include do arquivo de conexão
include 'include/conexao.php';

try{

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    if ($senha!= $confirmar){
        // cria um array para armazenar a mensagem de erro/sucesso
        $retorno = array(
                        'retorno'=>'erro',
                        'mensagem'=> 'Senhas não conferem, verifique e tente novamente'
                    );

        // cria uma variavel que ira receber o array acima convertido em JSON
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        // retorno em formato JSON
        echo $json;
        // encerra o script
        exit;
    }
    
        $sql = "INSERT INTO tb_login (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    
        $comando = $conexao->prepare($sql);

        $comando->execute();

        // cria um array para armazenar a mensagem de erro
        $retorno = array(
                        'retorno'=>'ok',
                        'mensagem'=> 'Usuário adicionado!'
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