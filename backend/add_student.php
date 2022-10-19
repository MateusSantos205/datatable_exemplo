<?php

include 'functions.php';

try{

$nome ='Mateus';
$curso ='Técnico em Informática';
$periodo = 'Noite';

$sql = "INSERT INTO  tb_aluno(nome,curso,periodo) VALUES ('$nome','$curso','$periodo')";

$msg = "Aluno cadastrado com sucesso";

insertUpdateDelele($sql,$msg);

}catch(PDOException $erro){
    
    pdocatch($erro);

}

// fechar a conexão
$conexao = null;

?>