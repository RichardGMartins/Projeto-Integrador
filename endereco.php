<?php 
include("cabecalhocliente.php");

$sql = "SELECT COUNT(fk_cli_id) FROM endereco_entrega WHERE fk_cli_id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $idclientes);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $cont);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

#VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
if ($cont < 1)
{
    echo "<script>window.location.href='cadastroendereco.php';</script>";
}

$sql = "SELECT * FROM endereco_entrega WHERE fk_cli_id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $idclientes);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $rua = $row['end_rua'];
    $numero = $row['end_numero'];
    $bairro = $row['end_bairro'];
    $cidade = $row['end_cidade']; 
    $estado = $row['end_estado']; 
    $pais = $row['end_pais']; 
    $complemento = $row['end_complemento'];
    $codigopostal = $row['end_codigo_postal'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $codigopostal = $_POST['codigopostal'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];

    $sql = "UPDATE endereco_entrega SET end_rua = ?, end_cidade = ?, end_estado = ?, end_pais = ?, end_codigo_postal = ?, end_complemento = ?, end_bairro = ?, end_numero = ? WHERE fk_cli_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi", $rua, $cidade, $estado, $pais, $codigopostal, $complemento, $bairro, $numero, $idclientes);
    mysqli_stmt_execute($stmt);

    echo ("<script>window.alert('Endereço alterado com sucesso!');</script>");
    echo ("<script>window.location.href='areacliente.php';</script>");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereço de Entrega</title>
    <link rel = "stylesheet" href="./css/styles.css">
</head>
<body>
<div class="div-alteraproduto">
    <div class="div-alteraprod">
        <form action="endereco.php?id=<?=$id?>" method="post">
        <h2 id='h2-alterarprod'>Endereço de Entrega</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Rua</label></label><br>
            <input type="text" name = "rua" value="<?=$rua?>"> <br>
            <label>Numero</label></label><br>
            <input type="number" name = "numero" value="<?=$numero?>"> <br>
            <label>Bairro</label></label><br>
            <input type="text" name = "bairro" value="<?=$bairro?>"> <br>
            <label>Complemento</label> <br>
            <input type="text" name ="complemento" value="<?=$complemento?>">
            <br>
            <label>Cidade</label> <br>
            <input type="text" name ="cidade" value="<?=$cidade?>">
            <br>
            <label>Estado</label> <br>
            <input type="text" name ="estado" value="<?=$estado?>">
            <br>
            <label>Pais</label> <br>
            <input type="text" name ="pais" value="<?=$pais?>">
            <br>
            <label>Codigo Postal</label> <br>
            <input type="text" name ="codigopostal" value="<?=$codigopostal?>">
            <br>
            <button type="submit" name = "cadastro" id = "btn">Alterar</button>
        </form>
    </div>
</div>
</body>
</html>
