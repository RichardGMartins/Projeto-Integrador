<?php 
include('cabecalhocliente.php');


$sql = "SELECT COUNT(fk_cli_id) FROM endereco_entrega WHERE fk_cli_id =$idclientes ";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno))
    {
        $cont = $tbl[0];
    }
    #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont < 1)
    {
        echo "<script>window.alert('FAÇA O CADASTRADO DE SEU ENDEREÇO !';</script>)";
        echo "<script>window.location.href='cadastroendereco.php;</script>";

    }

$sql = "SELECT * FROM endereco_entrega WHERE fk_cli_id = $idclientes";
$retorno = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($retorno)){
    $id = $tbl[0];
    $rua = $tbl[1];
    $numero =$tbl[9];
    $bairro =$tbl[8];
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
        <form action="endereco.php?id=<?=$id?>" method="post">
        <h2 id='h2-alterarprod'>Confirmação de Endereço de Entrega</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>" >
            <label>Rua</label></label><br>
            <input type="text" name = "rua" value="<?=$rua?>" readonly> <br>
            <label>Numero</label></label><br>
            <input type="number" name = "numero" value="<?=$numero?>" readonly> <br>
            <label>Bairro</label></label><br>
            <input type="text" name = "bairro" value="<?=$bairro?>" readonly> <br>
            <label>Complemento</label> <br>
            <input type="text" name ="complemento" value="<?=$complemento?>" readonly>
            <br>
            <label>Cidade</label> <br>
            <input type="text" name ="cidade" value="<?=$cidade?>" readonly>
            <br>
            <label>Estado</label> <br>
            <input type="text" name ="estado" value="<?=$estado?>" readonly>
            <br>
            <label>Pais</label> <br>
            <input type="text" name ="pais" value="<?=$pais?>" readonly>
            <br>
            <label>Codigo Postal</label> <br>
            <input type="text" name ="codigopostal" value="<?=$codigopostal?>" readonly>
            <br>
        </form>
        <a  id="click" href="finaliza_carrinho.php"><button id="btn4">Concluir Compra</button></a>
    </div>
</div>
</body>
</html>