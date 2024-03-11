<?php 
include("cabecalhocliente.php");

$id = $_GET['id'];

$sql = "SELECT COUNT(fk_cli_id) FROM endereco_entrega WHERE fk_cli_id =$id ";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno))
    {
        $cont = $tbl[0];
    }
    #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont < 1)
    {
        echo "<script>window.location.href='cadastroendereco.php';</script>";
    }

    $sql = "SELECT * FROM endereco_entrega WHERE fk_cli_id =$id";
    $retorno = mysqli_query($link,$sql);

    while ($tbl = mysqli_fetch_array($retorno)){
        $rua = $tbl[1];
        $cidade = $tbl[2]; 
        $estado = $tbl[3]; 
        $pais = $tbl[4]; 
        $complemento = $tbl[7];
        $codigopostal = $tbl[5];
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
        <form action="endereco.php" method="post">
        <h2 id='h2-alterarprod'>Endereço de Entrega</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Rua</label></label><br>
            <input type="text" name = "rua" value="<?=$rua?>"> <br>
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
            <input type="number" name ="codigopostal" value="<?=$codigopostal?>">
            <br>
            <button type="submit" name = "cadastro" id = "btn">Alterar</button>
        </form>
    </div>
</div>
</body>
</html>
