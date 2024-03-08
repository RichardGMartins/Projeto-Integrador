<?php 
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $login = $_POST['login'];
    $ativo = $_POST['ativo'];
    $senha = $_POST['senha'];

    #BUSCAR O TEMPERO
    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_login = $login";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $tempero = $tbl[0];
    }
    #CASO A SENHA TENHA SIDO MODIFICADA
    if($senha != $senha2){
        $senha = md5($senha.$tempero);
    }
    $sql = "UPDATE usuarios SET usu_senha = '$senha',usu_login = '$login', usu_ativo = '$ativo' WHERE usu_id = $id";
    mysqli_query($link,$sql);

    echo("<script>window.alert('Usuario alterado com sucesso !')</script>");
    echo("<script>window.location.href='listausuarios.php';</script>");
    exit();
}
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE usu_id =$id";
    $retorno = mysqli_query($link,$sql);

    while ($tbl = mysqli_fetch_array($retorno)){
        $login = $tbl[1]; #Campo nome
        $senha = $tbl[2]; #Campo senha
        $ativo = $tbl[3]; #Campo ativo
        $tempero = $tbl[4]; #Campo tempero
        $senha2 = $senha; #Campo 2 senha 2 para verificar se foi feita alguma mudança em senha
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Usuário</title>
    <link rel = "stylesheet" href="./css/styles.css">
</head>
<body>
<div class="div-alteraproduto">
    <div class="div-alteraprod">
        <form action="alterausuario.php" method="post">
        <h2 id='h2-alterarprod'>Alteração dos Usuarios</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Login</label><br>
            <input type="text" name = "nome" value="<?=$login?>" required> <br>
            <label>Senha</label> <br>
            <input type="password" name ="senha" value="<?=$senha?>" required>
            <br>
            <label id="lb-form">Status: <?= $check = ($ativo =='s') ? "Ativo" : "Inativo" ?> </label>
            <br>
            <input type="radio" name = "ativo" value="s" <?=$ativo == "s" ? "checked" : "" ?>> ATIVO <br>
            <input type="radio" name = "ativo" value="n" <?=$ativo == "n" ? "checked" : "" ?>> INATIVO <br>
            <button type="submit" name = "cadastro" id = "btn">Alterar</button>
        </form>
    </div>
</div>
</body>
</html>