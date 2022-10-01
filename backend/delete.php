<?php

include 'functions.php';

try{

$id = $_POST['id'];

$sql = "DELETE FROM tb_login where id = $id";

$msg = "Usuário deletado com sucesso";

insertUpdateDelele($sql,$msg);

}catch(PDOException $erro){
    
    pdocatch($erro);

}

// fechar a conexão
$conexao = null;

?>