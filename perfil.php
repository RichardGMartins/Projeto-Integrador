<?php 
include("cabecalhocliente.php");

$id = $_GET['id'];
$sql = "SELECT * FROM cliente WHERE cli_id =$id";
$retorno = mysqli_query($link,$sql);
while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1]; #Campo nome
    $email = $tbl[2]; #Campo email
    $telefone = $tbl[3]; #Campo telefone
    $cpf = $tbl[4]; #Campo cpf
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL USUARIO</title>
    <link rel = "stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="div-alterarusuario">
    <div class="div-alterarusu">
            <h2>PERFIL</h2><br>
        <form action="alterarcliente.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label><br>
            <input type="text" name ="nome" value="<?=$nome?>" readonly> <br>
            <label>Email</label> <br>
            <input type="email" name ="email" value="<?=$email?>" readonly> <br>
            <label>CPF</label> <br>
            <input type="number" name ="cpf" value="<?=$cpf?>" readonly> <br>
            <label>Telefone</label> <br>
            <input type="number" name ="telefone" value="<?=$telefone?>" readonly> <br>
            <button><a href="alterarcliente.php?id=<?=$id?>">ALTERAÇÃO DE CADASTRO</a></button>
        </form>
    </div>
    </div>
</body>