<?php

// include do arquivo de conexão
include 'functions.php';

try{

    $id = $_POST['id'];
  
        $sql = "UPDATE tb_login SET ativo = NOT ativo WHERE id = $id";
    
       $msg = "Usúario alterado com sucesso!";

       insertUpdateDelele($sql,$msg);

          
}catch(PDOException $erro){

    pdocatch($erro);

}

// fechar a conexão
    $conexao = null;


?>