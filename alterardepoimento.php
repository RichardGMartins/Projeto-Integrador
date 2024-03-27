<?php
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $resposta = $_POST['resposta'];

    $sql = "UPDATE depoimento SET depo_respondido = ? WHERE depo_id = ? ";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "si", $resposta,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    echo("<script>window.alert('Depoimento alterado com sucesso !')</script>");
    echo("<script>window.location.href='areaadmin.php';</script>");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM depoimento WHERE depo_id =$id";
echo $sql;
$retorno = mysqli_query($link,$sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1];
    $email = $tbl[2]; 
    $telefone = $tbl[3]; 
    $mensagem = $tbl[4]; 
    $resposta = $tbl[5]; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTERAR DEPOIMENTOS</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="div-alteraproduto">
    <div class="div-alteraprod">
        <form action="alterardepoimento.php" method="post">
        <h2 id='h2-alterarprod'>Alteração de Depoimento</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME</label><br>
            <input type="text" name = "nome" value="<?=$nome?>"> <br>
            <label>EMAIL</label> <br>
            <input type="text" name ="email" value="<?=$email?>"><br>
            <label>TELEFONE</label> <br>
            <input type="text" name ="telefone" value="<?=$telefone?>"><br>
            <label>MENSAGEM</label> <br>
            <input type="text" name ="mensagem" value="<?=$mensagem?>"><br>
            <label id="lb-form">Status: <?= $check = ($resposta =='sim') ? "Respondido" : "Não respondido" ?> </label>
            <br>
            <input type="radio" name = "resposta" value="sim" <?=$resposta == "sim" ? "checked" : "" ?>> Respondido <br>
            <input type="radio" name = "resposta" value="nao" <?=$resposta == "nao" ? "checked" : "" ?>> Não Respondido <br>
            <button type="submit" name = "cadastro" id = "btn">Alterar</button>
        </form>
    </div>
</body>
</html>