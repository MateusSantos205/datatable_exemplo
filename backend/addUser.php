<?php


// include do arquivo de conexão

include 'functions.php';
// include do arquivo que envia o email
include 'envia_email.php';


try{
    // define os caracteres que serao removidosdos campos preenchidos no form (replace)
    $carac = array('(', ')', '-', '.', ' ');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = str_replace($carac, "", $_POST['telefone']);
    $cpf = str_replace($carac, "", $_POST['cpf']);
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    // valida se o campo esta preenchido
    validaCampoVazio($nome, 'nome');
    validaCampoVazio($email, 'email');
    validaCampoVazio($telefone, 'telefone');
    validaCampoVazio($cpf, 'cpf');
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
    
        $sql = "INSERT INTO tb_login (nome, email, telefone, cpf, senha) VALUES ('$nome', '$email', '$telefone', '$cpf', '$senha')";

        $msg = "Usuário adicionado com sucesso!";  
          
        insertUpdateDelele($sql,$msg);

        // função que gera um token para ativar a conta do usuario
        $token = geraTokenUsuario($email);

        // envia o email se o insert for executado
        enviaEmail($email,$nome,$token);   

          
}catch(PDOException $erro){

   pdocatch($erro);

}

// fechar a conexão
    $conexao = null;
