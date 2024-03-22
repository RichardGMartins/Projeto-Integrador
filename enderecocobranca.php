<?php 
include("cabecalhocliente.php");


$sql = "SELECT COUNT(fk_cli_id) FROM endereco_cobranca WHERE fk_cli_id =$idclientes ";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno))
    {
        $cont = $tbl[0];
    }
    #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont < 1)
    {
        echo "<script>window.location.href='cadastroenderecocobranca.php';</script>";
    }
    else{

    $sql = "SELECT * FROM endereco_cobranca WHERE fk_cli_id =$idclientes";
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
        
        $sql = "UPDATE endereco_cobranca SET end_cob_rua = '$rua', end_cob_cidade = '$cidade', end_cob_estado = '$estado',end_cob_pais = '$pais',end_cob_codigo_postal ='$codigopostal',end_cob_complemento ='$complemento', end_cob_bairro ='$bairro', end_cob_numero = '$numero' WHERE fk_cli_id = $idclientes";
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
    <title>Endereço de Cobrança</title>
    <link rel = "stylesheet" href="./css/styles.css">
</head>
<body>
<div class="div-alteraproduto">
    <div class="div-alteraprod">
        <form action="enderecocobranca.php?id=<?=$id?>" method="post">
        <h2 id='h2-alterarprod'>Endereço de Cobrança</h2><br>
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
