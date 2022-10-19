<?php
include 'include/conexao.php';

try {

    $token = $_GET['token'];

    $sql = "
    UPDATE 
        tb_login u 
    INNER JOIN 
        tb_usuarios_token t 
    ON 
        t.fk_id_usuarios = u.id
    SET 
        u.ativo = 1 
    WHERE 
        t.token = '$token'
    ";

    $comando = $conexao->prepare($sql);
    $comando->execute();

    // p rowCount é uma função que retorna o numero de linhas afetadas com o SQL
    $retorno = $comando->rowCount();
} catch (PDOException $error) {
    $retorno = 0;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Sistema Senac - Ativação de Conta</title>
</head>

<body>

    <div class="container-sm mt-4">

        <div class="alert <?php echo $retorno != 0 ? 'alert-success' : 'alert-danger'; ?>" role="alert">
<!-- /////////////////////////////////////////////////////// -->
            <?php 
                echo $retorno != 0 ? '<p>Cadastro ativado com sucesso!!!</p>' : '<p>Erro ao ativar o cadastro!!!</p>';
            ?>
<!-- /////////////////////////////////////////////////////// -->
            <a href="../index.html">
            <button type="button" class="btn btn-primary">Acessar Sistema</button>
            </a>
        </div>

    </div>










    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>