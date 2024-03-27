<?php 
include("cabecalho.php");

$sql = "SELECT car_id,car_valorvenda, car_datavenda, car_total_item, cli_nome, fk_cli_id FROM carrinho INNER JOIN cliente ON fk_cli_id = cli_id WHERE car_finalizada = 's'"; 
$return = mysqli_query($link,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="./css/styles.css">
    <title>VENDAS</title>
</head>
<body>
    <div class="background"> 
                <form action="historicovendas.php" method="post">
                <!-- Required é usado para o usuario tentar passar em branco o cadastro e impedir o mesmo -->
                <input type="radio" name ="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>> ATIVOS 
                <br>
                <input type="radio" name ="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>> INATIVOS 
                <br>   
                <input type="radio" name="ativo" class="radio" value="t" required onclick="submit()" <?= $ativo =='t' ? "checked" : "" ?>> TODOS 
            </form>
            </div>
    <div class="container" id="center-container">
    <table border="1">
        <h3>HISTORICO DE VENDAS</h3>
        <th>Valor da Venda</th>
        <th>Data da Venda</th>
        <th>Total de itens</th>
        <th>ID Cliente</th>
        <th>Cliente</th>
        <?php 
        while ($tbl = mysqli_fetch_array($return)){
            ?>
        <tr>
            <td>R$ <?= $tbl[1]?></td>
            <td><?= $tbl[2]?></td>
            <td><?= $tbl[3]?></td>
            <td><?= $tbl[5]?></td>
            <td><?= $tbl[4]?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
    
</body>
</html>