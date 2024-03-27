<?php
include("cabecalhocliente.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $codigopostal = $_POST['codigopostal'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];

    $sql = "SELECT COUNT(fk_cli_id) FROM endereco_cobranca WHERE fk_cli_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idclientes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cont);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($cont == 1)
    {
        echo "<script>window.alert('ENDEREÇO JÁ CADASTRADO!');</script>";
    }
    else
    {
        $sql = "INSERT INTO endereco_cobranca (end_cob_rua,end_cob_cidade,end_cob_estado,end_cob_pais,end_cob_codigo_postal,fk_cli_id,end_cob_complemento,end_cob_bairro,end_cob_numero)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sssssisss", $rua, $cidade, $estado, $pais, $codigopostal, $idclientes, $complemento, $bairro, $numero);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "<script>window.alert('ENDEREÇO CADASTRADO COM SUCESSO!');</script>";
        echo "<script>window.location.href='areacliente.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Cadastrar Endereço de Cobrança</title>
</head>
<body>
    <div id="div-produto">
        <div id="div-produtos">
                <h2>Cadastro de Endereço de Cobrança</h2>
            <form action="cadastroenderecocobranca.php>" method="post" >
                <label for="">Rua</label>
                <br>
                <input type="text" name='rua' id="rua">
                <br>
                <label for="">Numero</label>
                <br>
                <input type="number"  name='numero' id="numero">
                <br>
                <label for="">Complemento</label>
                <br>
                <input type="text" name='complemento' id="complemento">
                <br>
                <label for="">Bairro</label>
                <br>
                <input type="text" name='bairro' id="bairro"></input>
                <br>
                <label for="">Cidade</label>
                <br>
                <input type="text" name='cidade' id="cidade">
                <br>
                <label for="">Estado</label>
                <br>
                <input type="text" name='estado' id="estado">
                <br>
                <label for="">Pais</label>
                <br>
                <input type="text" name='pais' id="pais">
                <br>
                <label for="">Codigo Postal</label>
                <br>
                <input type="text"  name='codigopostal' id="codigopostal">
                <br>
                <button type="submit" id="btn">CADASTRAR</button>
            </form>
        </div>
    </div>
</body>
</html>