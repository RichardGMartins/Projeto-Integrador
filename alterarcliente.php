<?php 
include ('cabecalhocliente.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $datanascimento = $_POST['datanascimento'];

    #BUSCAR O TEMPERO
    $sql = "SELECT cli_tempero FROM cliente WHERE cli_email = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $tempero);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    #CASO A SENHA TENHA SIDO MODIFICADA
    if($senha != $senha2){
        $senha = md5($senha.$tempero);
    }

    $sql = "UPDATE cliente SET cli_nome = ?, cli_email = ?, cli_telefone = ?, cli_senha = ?, cli_genero = ?, cli_datanascimento = ? WHERE cli_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $nome, $email, $telefone, $senha, $genero, $datanascimento, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo("<script>window.alert('Usuário alterado com sucesso!')</script>");
    echo("<script>window.location.href='perfil.php';</script>");
    exit();
}

$sql = "SELECT * FROM cliente WHERE cli_id =$idclientes";
$retorno = mysqli_query($link,$sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1]; #Campo nome
    $email = $tbl[2]; #Campo ativo
    $telefone = $tbl[3]; #Campo telefone
    $cpf = $tbl[4];
    $datanascimento = $tbl[9]; #Campo curso
    $genero = $tbl[8]; #Campo sala
    $senha2 = $senha;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Usuário</title>
    <link rel = "stylesheet" href="./css/style.css">
</head>
<body>
<div class="div-alterarusuario">
    <div class="div-alterarusu">
        <h2  id='h2-alterarprod'>Alteração de dados</h2>
        <form action="alterarcliente.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label><br>
            <input type="text" name = "nome" value="<?=$nome?>" required><br>
            <label>Email</label><br>
            <input type="email" name ="email" value="<?=$email?>"required><br>
            <label>Telefone</label><br>
            <input type="number" name ="telefone" value="<?=$telefone?>"required><br>
            <label>Cpf</label><br>
            <input type="text" name ="cpf" value="<?=$cpf?>"required><br>
            <label>Gênero</label><br>
            <select name="genero" id="genero">
                    <option value="vazio"<?php if ($genero == null) echo 'selected'; ?>>Selecione o gênero</option>
                    <option value="masculino"  <?php if ($genero == 'masculino') echo 'selected'; ?>>Masculino</option>
                    <option value="feminino" <?php if ($genero == 'feminino') echo 'selected'; ?>>Feminino</option>
                    <option value="naoidentificar"  <?php if ($genero == 'naoidentificar') echo 'selected'; ?>>Não Identificar</option>
                </select><br>
            <label>Data de Nascimento</label><br>
            <input type="date" name ="datanascimento" value="<?=$datanascimento?>"required>
            <br>
            <button type="submit" name = "cadastro" id = "btn">ALTERAR</button>
        </form>
        <a href="recuperasenha.php"><button>ALTERAR SENHA</button></a>
    </div>
</div>
</body>
</html>