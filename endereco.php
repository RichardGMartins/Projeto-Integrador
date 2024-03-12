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
        echo "<script>window.location.href='cadastroendereco.php?id=$id';</script>";
    }

    $sql = "SELECT * FROM endereco_entrega WHERE fk_cli_id =$id";
    $retorno = mysqli_query($link,$sql);

    while ($tbl = mysqli_fetch_array($retorno)){
        $rua = $tbl[1];
        $numero =$tbl[9];
        $bairro =$tbl[8];
        $cidade = $tbl[2]; 
        $estado = $tbl[3]; 
        $pais = $tbl[4]; 
        $complemento = $tbl[7];
        $codigopostal = $tbl[5];
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $rua = $_POST['rua'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $pais = $_POST['pais'];
        $codigopostal = $_POST['codigopostal'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $numero = $_POST['numero'];
        
        $sql = "UPDATE endereco_entrega SET end_rua = '$rua', end_cidade = '$cidade', end_estado = '$estado',end_pais = '$pais',end_codigo_postal ='$codigopostal',end_complemento ='$complemento', end_bairro ='$bairro', end_numero = '$numero' WHERE fk_cli_id = $id";
        mysqli_query($link, $sql);

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
