<?php
try {
    //dados da conexão com o BD
    define('SERVIDOR', 'localhost');
    define('USUARIO', 'root');
    define('SENHA', '');
    define('BASEDADOS', 'db_database');

    $conexao = new PDO("mysql:host=".SERVIDOR.";dbname=".BASEDADOS.";charset=utf8", USUARIO, SENHA);
    // set the PDO error mode to exception
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    
} catch (PDOException $erro) {
    echo "Erro ao conectar no banco de dados: " .$erro->getMessage();
}


