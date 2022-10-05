<?php

// include do arquivo de conexão

include 'functions.php';

try{

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    // valida se o campo esta preenchido
    validaCampoVazio($nome, 'nome');
    validaCampoVazio($email, 'email');
    validaCampoVazio($senha, 'senha');
    validaCampoVazio($confirmar, 'confirmar senha');

    // executa a função e verifica se o email já esta cadastrado
    checkEmailUser($email);

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

    // criptografa a senha do usuario
    // alguns algoritimos de criptografar senhas = sha1, md5, password hash php

    $salt = 
    $senha = sha1($senha); 
    
    
        $sql = "INSERT INTO tb_login (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        $msg = "Usuário adicionado com sucesso!";  
          
        insertUpdateDelele($sql,$msg);

          
}catch(PDOException $erro){

   pdocatch($erro);


}

// fechar a conexão
    $conexao = null;
